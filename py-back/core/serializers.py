from rest_framework import serializers

from .models import Tournament


class TournamentSerializer(serializers.ModelSerializer):
    max_players = serializers.IntegerField(min_value=2, max_value=512)

    class Meta:
        model = Tournament
        fields = (
            'id',
            'creator_id',
            'title',
            'game',
            'description',
            'starts_at',
            'max_players',
            'status',
            'moderation_status',
            'created_at',
        )
        read_only_fields = ('id', 'creator_id', 'status', 'moderation_status', 'created_at')
