from django.db import migrations, models


class Migration(migrations.Migration):
    dependencies = [
        ('core', '0001_initial'),
    ]

    operations = [
        migrations.SeparateDatabaseAndState(
            database_operations=[
                migrations.AlterModelTable(
                    name='tournament',
                    table='tournaments',
                ),
                migrations.AlterModelTable(
                    name='tournamententry',
                    table='tournament_entries',
                ),
            ],
            state_operations=[
                migrations.RemoveConstraint(
                    model_name='tournamententry',
                    name='unique_tournament_entry_per_user',
                ),
                migrations.RemoveField(
                    model_name='tournament',
                    name='creator',
                ),
                migrations.AddField(
                    model_name='tournament',
                    name='creator_id',
                    field=models.IntegerField(db_index=True),
                ),
                migrations.AlterField(
                    model_name='tournament',
                    name='id',
                    field=models.AutoField(primary_key=True, serialize=False),
                ),
                migrations.RemoveField(
                    model_name='tournamententry',
                    name='tournament',
                ),
                migrations.RemoveField(
                    model_name='tournamententry',
                    name='user',
                ),
                migrations.AddField(
                    model_name='tournamententry',
                    name='tournament_id',
                    field=models.IntegerField(db_index=True),
                ),
                migrations.AddField(
                    model_name='tournamententry',
                    name='user_id',
                    field=models.IntegerField(db_index=True),
                ),
                migrations.AlterField(
                    model_name='tournamententry',
                    name='id',
                    field=models.AutoField(primary_key=True, serialize=False),
                ),
                migrations.AddConstraint(
                    model_name='tournamententry',
                    constraint=models.UniqueConstraint(
                        fields=('tournament_id', 'user_id'),
                        name='unique_tournament_entry_per_user',
                    ),
                ),
            ],
        ),
    ]
