from django.db import IntegrityError, models, transaction
from rest_framework import status, viewsets
from rest_framework.decorators import action
from rest_framework.exceptions import ValidationError
from rest_framework.permissions import AllowAny, BasePermission, IsAuthenticated
from rest_framework.response import Response
from rest_framework.views import APIView

from .models import Tournament, TournamentEntry
from .serializers import TournamentSerializer


class HealthView(APIView):
	permission_classes = (AllowAny,)

	def get(self, request):
		return Response({'status': 'ok', 'service': 'mateable-python-api'})


class IsTournamentOwnerOrStaff(BasePermission):
	def has_object_permission(self, request, view, obj):
		if request.method in ('GET', 'HEAD', 'OPTIONS'):
			return True
		return request.user.is_staff or obj.creator_id == request.user.id


class TournamentViewSet(viewsets.ModelViewSet):
	serializer_class = TournamentSerializer

	def get_queryset(self):
		tournaments = Tournament.objects.all()
		if self.request.user.is_staff:
			return tournaments
		if self.request.user.is_authenticated:
			return tournaments.filter(
				models.Q(moderation_status=Tournament.ModerationStatus.APPROVED)
				| models.Q(creator_id=self.request.user.id)
			).distinct()
		return tournaments.filter(moderation_status=Tournament.ModerationStatus.APPROVED)

	def get_permissions(self):
		if self.action == 'join':
			return [IsAuthenticated()]
		if self.action in ('create', 'update', 'partial_update', 'destroy'):
			return [IsAuthenticated(), IsTournamentOwnerOrStaff()]
		return [AllowAny()]

	def perform_create(self, serializer):
		serializer.save(
			creator_id=self.request.user.id,
			moderation_status=Tournament.ModerationStatus.PENDING,
		)

	@action(detail=True, methods=('post',), permission_classes=(IsAuthenticated,))
	def join(self, request, pk=None):
		tournament = self.get_object()
		if tournament.status != Tournament.Status.OPEN:
			raise ValidationError({'detail': 'This tournament is closed.'})
		if tournament.moderation_status != Tournament.ModerationStatus.APPROVED:
			raise ValidationError({'detail': 'This tournament is not approved.'})

		try:
			with transaction.atomic():
				locked_tournament = Tournament.objects.select_for_update().get(pk=tournament.pk)
				entry_count = TournamentEntry.objects.filter(
					tournament_id=locked_tournament.pk
				).count()
				if entry_count >= locked_tournament.max_players:
					raise ValidationError({'detail': 'This tournament is full.'})
				TournamentEntry.objects.create(
					tournament_id=locked_tournament.pk,
					user_id=request.user.id,
				)
		except IntegrityError as error:
			raise ValidationError({'detail': 'You have already joined this tournament.'}) from error

		return Response({'joined': True}, status=status.HTTP_201_CREATED)
