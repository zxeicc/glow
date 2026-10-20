# Glow — Laravel E-commerce Application

Glow is a Laravel-based e-commerce application with administrative interfaces for managing products, brands, categories, product variants, and users.

The project uses Docker Compose to run PHP-FPM, Nginx, and MySQL in separate services.

## Tech Stack

- **Backend:** PHP 8.4, Laravel 13
- **Authentication:** Laravel Sanctum
- **Database:** MySQL 8.4
- **Web Server:** Nginx
- **Runtime:** Docker and Docker Compose
- **Testing:** PHPUnit

## Features

- User registration, login, and logout endpoints
- Administrative authentication
- Product management
- Brand management
- Category and subcategory management
- Product variant management
- Color and size management
- Administrative user management
- Database migrations and persistent MySQL storage

## Architecture

```text
Browser
   |
   v
Nginx :8080
   |
   v
PHP-FPM / Laravel
   |
   v
MySQL :3306
```

Docker Compose defines three services:

| Service | Purpose |
| --- | --- |
| `app` | Runs Laravel using PHP-FPM |
| `nginx` | Handles HTTP requests on host port 8080 |
| `db` | Runs MySQL 8.4 with a persistent Docker volume |

## Requirements

- Docker Desktop
- Docker Compose v2
- Git

## Getting Started

### 1. Clone the repository

```bash
git clone <YOUR_REPOSITORY_URL>
cd app
```

Replace `<YOUR_REPOSITORY_URL>` with your GitHub repository URL.

### 2. Configure environment variables

Create a local environment file from the example:

```powershell
Copy-Item .env.example .env
```

Set the following values in `.env`:

```dotenv
APP_NAME=Glow
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=change-this-database-password

MYSQL_ROOT_PASSWORD=change-this-root-password
```

Use your own local passwords. Do not commit `.env` or real credentials to Git.

### 3. Build and start the containers

```bash
docker compose up -d --build
```

### 4. Generate the application key

```bash
docker compose exec app php artisan key:generate
```

### 5. Run database migrations

```bash
docker compose exec app php artisan migrate
```

### 6. Open the application

Visit:

http://localhost:8080

Check the available application routes with:

```bash
docker compose exec app php artisan route:list
```

## Useful Docker Commands

Start the services:

```bash
docker compose up -d
```

View service status:

```bash
docker compose ps
```

Follow application service logs:

```bash
docker compose logs -f app
```

Stop the services:

```bash
docker compose down
```

Stop the services and remove the database volume **(deletes local database data)**:

```bash
docker compose down -v
```

## Testing

Run the Laravel test suite:

```bash
docker compose exec app php artisan test
```

## Security Notes

- Keep `.env` out of version control.
- Use unique credentials for local database access.
- Do not use development settings such as `APP_DEBUG=true` in production.
- Review authentication and authorization rules before exposing the application publicly.

## Project Status

This repository documents a local development setup. Public deployment is not included in the current setup.

## License

No project-specific license has been declared yet.
