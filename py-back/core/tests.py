from datetime import timedelta

from django.contrib.auth import get_user_model
from django.urls import reverse
from django.utils import timezone
from rest_framework.test import APITestCase

from .models import Tournament, TournamentEntry


class HealthEndpointTests(APITestCase):
	def test_health_endpoint_is_public(self):
		response = self.client.get(reverse('api:health'))

		self.assertEqual(response.status_code, 200)
		self.assertEqual(response.data['status'], 'ok')


class TournamentApiTests(APITestCase):
	def setUp(self):
		user_model = get_user_model()
		self.creator = user_model.objects.create_user(username='creator', password='test-password')
		self.player = user_model.objects.create_user(username='player', password='test-password')
		self.tournament = Tournament.objects.create(
			creator_id=self.creator.pk,
			title='Community Cup',
			game='Arcade Showdown',
			description='A local test tournament.',
			starts_at=timezone.now() + timedelta(days=2),
			max_players=2,
			moderation_status=Tournament.ModerationStatus.APPROVED,
		)

	def test_public_list_only_includes_approved_tournaments(self):
		Tournament.objects.create(
			creator_id=self.creator.pk,
			title='Pending Event',
			game='Arcade Showdown',
			description='Awaiting moderation.',
			starts_at=timezone.now() + timedelta(days=3),
		)

		response = self.client.get(reverse('api:tournament-list'))

		self.assertEqual(response.status_code, 200)
		self.assertEqual([item['title'] for item in response.data], ['Community Cup'])

	def test_authenticated_create_is_pending_moderation(self):
		self.client.force_authenticate(self.creator)
		response = self.client.post(reverse('api:tournament-list'), {
			'title': 'New Cup',
			'game': 'Arcade Showdown',
			'description': 'A tournament submitted using the API.',
			'starts_at': (timezone.now() + timedelta(days=4)).isoformat(),
			'max_players': 8,
		}, format='json')

		self.assertEqual(response.status_code, 201)
		created = Tournament.objects.get(pk=response.data['id'])
		self.assertEqual(created.creator_id, self.creator.pk)
		self.assertEqual(created.moderation_status, Tournament.ModerationStatus.PENDING)

	def test_join_requires_authentication_and_prevents_duplicates(self):
		join_url = reverse('api:tournament-join', kwargs={'pk': self.tournament.pk})
		self.assertEqual(self.client.post(join_url).status_code, 401)

		self.client.force_authenticate(self.player)
		self.assertEqual(self.client.post(join_url).status_code, 201)
		self.assertEqual(self.client.post(join_url).status_code, 400)
		self.assertEqual(TournamentEntry.objects.filter(tournament_id=self.tournament.pk).count(), 1)
