import re
from urllib.parse import urlsplit

from django.conf import settings
from django.db import connections
from rest_framework.authentication import BaseAuthentication
from rest_framework.exceptions import AuthenticationFailed


_SESSION_ID_PATTERN = re.compile(r'^[A-Za-z0-9,-]{1,128}$')
_UNSAFE_METHODS = {'POST', 'PUT', 'PATCH', 'DELETE'}


class PHPUser:
    """Minimal authenticated principal resolved from the PHP users table."""

    def __init__(self, user_id, email, role):
        self.id = int(user_id)
        self.pk = self.id
        self.email = email
        self.username = email
        self.role = int(role or 0)
        self.is_staff = self.role >= 2
        self.is_superuser = self.role >= 2

    @property
    def is_authenticated(self):
        return True

    @property
    def is_anonymous(self):
        return False

    def get_username(self):
        return self.username


class PHPSessionAuthentication(BaseAuthentication):
    """Authenticate using a live, server-side PHP session record."""

    def authenticate(self, request):
        session_id = request.COOKIES.get(settings.PHP_SESSION_COOKIE_NAME, '')
        if not session_id:
            return None
        if not _SESSION_ID_PATTERN.fullmatch(session_id):
            raise AuthenticationFailed('Invalid PHP session.')

        if request.method in _UNSAFE_METHODS:
            origin = request.headers.get('Origin', '').rstrip('/')
            if not origin or origin not in settings.CORS_ALLOWED_ORIGINS:
                raise AuthenticationFailed('Untrusted request origin.')

        with connections['php'].cursor() as cursor:
            cursor.execute(
                'SELECT users.id, users.email, users.role '
                'FROM sessions '
                'INNER JOIN users ON users.id = sessions.user_id '
                'WHERE sessions.session_id = %s '
                'AND sessions.user_id IS NOT NULL '
                'AND sessions.expires_at > UTC_TIMESTAMP() '
                'LIMIT 1',
                [session_id],
            )
            row = cursor.fetchone()

        if row is None:
            raise AuthenticationFailed('PHP session is invalid or expired.')

        return PHPUser(*row), session_id

    def authenticate_header(self, request):
        return f'{settings.PHP_SESSION_COOKIE_NAME} realm="mateable-api"'
