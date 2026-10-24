from django.contrib import admin
from .models import Tournament, TournamentEntry


@admin.register(Tournament)
class TournamentAdmin(admin.ModelAdmin):
	list_display = ('title', 'game', 'starts_at', 'status', 'moderation_status', 'creator_id')
	list_filter = ('status', 'moderation_status', 'game')
	search_fields = ('title', 'game', 'description')
	readonly_fields = ('created_at',)


@admin.register(TournamentEntry)
class TournamentEntryAdmin(admin.ModelAdmin):
	list_display = ('tournament_id', 'user_id', 'created_at')
	list_filter = ('created_at',)
	readonly_fields = ('created_at',)
