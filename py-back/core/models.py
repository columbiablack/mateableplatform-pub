from django.db import models


class Tournament(models.Model):
	class Status(models.TextChoices):
		OPEN = 'open', 'Open'
		CLOSED = 'closed', 'Closed'

	class ModerationStatus(models.TextChoices):
		PENDING = 'pending', 'Pending'
		APPROVED = 'approved', 'Approved'
		REJECTED = 'rejected', 'Rejected'

	id = models.AutoField(primary_key=True)
	creator_id = models.IntegerField(db_index=True)
	title = models.CharField(max_length=120)
	game = models.CharField(max_length=120)
	description = models.TextField()
	starts_at = models.DateTimeField()
	max_players = models.PositiveIntegerField(default=16)
	status = models.CharField(max_length=20, choices=Status.choices, default=Status.OPEN)
	moderation_status = models.CharField(
		max_length=20,
		choices=ModerationStatus.choices,
		default=ModerationStatus.PENDING,
	)
	created_at = models.DateTimeField(auto_now_add=True)

	class Meta:
		db_table = 'tournaments'
		ordering = ('starts_at',)
		indexes = [
			models.Index(fields=('moderation_status', 'starts_at')),
		]

	def __str__(self) -> str:
		return self.title


class TournamentEntry(models.Model):
	id = models.AutoField(primary_key=True)
	tournament_id = models.IntegerField(db_index=True)
	user_id = models.IntegerField(db_index=True)
	created_at = models.DateTimeField(auto_now_add=True)

	class Meta:
		db_table = 'tournament_entries'
		ordering = ('created_at',)
		constraints = [
			models.UniqueConstraint(
				fields=('tournament_id', 'user_id'),
				name='unique_tournament_entry_per_user',
			),
		]

	def __str__(self) -> str:
		return f'{self.user_id} in {self.tournament_id}'
