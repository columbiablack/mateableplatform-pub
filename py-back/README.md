# Mateable Python API

A Django REST API that runs alongside the existing PHP site. The first API slice provides health checks and tournament workflows.

## Setup

From this directory in PowerShell:

```powershell
.\.venv\Scripts\Activate.ps1
python -m pip install -r requirements.txt
Copy-Item .env.example .env
python manage.py migrate
python manage.py createsuperuser
python manage.py runserver 127.0.0.1:8001
```

The development database is SQLite. Set `DJANGO_SECRET_KEY`, `DJANGO_DEBUG`, `DJANGO_ALLOWED_HOSTS`, and `DJANGO_DB_NAME` through the environment for deployment. Do not use the example secret in production.

## API

- `GET /api/v1/health/`: public service status
- `GET /api/v1/tournaments/`: approved tournaments
- `POST /api/v1/tournaments/`: authenticated tournament submission; new events await moderation
- `GET /api/v1/tournaments/{id}/`: public tournament details for approved events
- `POST /api/v1/tournaments/{id}/join/`: authenticated tournament entry

Use Django's admin at `/admin/` to approve submitted tournaments. API writes use Django session or HTTP Basic authentication in development.

## Tests

```powershell
python manage.py test
```