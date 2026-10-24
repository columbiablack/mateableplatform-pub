from django.conf import settings


class PHPDatabaseRouter:
    shared_models = {'tournament', 'tournamententry'}

    def db_for_read(self, model, **hints):
        if settings.PHP_DATABASE_ENABLED and self._is_shared_model(model):
            return 'php'
        return None

    def db_for_write(self, model, **hints):
        if settings.PHP_DATABASE_ENABLED and self._is_shared_model(model):
            return 'php'
        return None

    def allow_relation(self, obj1, obj2, **hints):
        if settings.PHP_DATABASE_ENABLED and (
            self._is_shared_model(obj1.__class__) or self._is_shared_model(obj2.__class__)
        ):
            return obj1._state.db == obj2._state.db
        return None

    def allow_migrate(self, db, app_label, model_name=None, **hints):
        if settings.PHP_DATABASE_ENABLED and db == 'php':
            return False
        return None

    @classmethod
    def _is_shared_model(cls, model):
        return model._meta.app_label == 'core' and model._meta.model_name in cls.shared_models
