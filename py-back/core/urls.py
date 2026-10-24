from django.urls import include, path
from rest_framework.routers import DefaultRouter

from .views import HealthView, TournamentViewSet

router = DefaultRouter()
router.register('tournaments', TournamentViewSet, basename='tournament')

urlpatterns = [
    path('health/', HealthView.as_view(), name='health'),
    path('', include(router.urls)),
]