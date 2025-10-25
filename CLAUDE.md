# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**MATCH** - A band member matching platform where musicians can find bandmates. Built as a Japanese-language service with Laravel 12 + Vue 3.

**Tech Stack**: Laravel 12 (PHP 8.2+), Vue 3, Tailwind CSS 4, MySQL 8.0, Docker

**Development Approach**: Mock-first implementation workflow (mock data → UI → real data integration)

## Architecture & Structure

### Docker Environment

Uses custom Docker setup (NOT Laravel Sail) with 4 services:
- `app` - PHP-FPM container (working directory: `/var/www/html`)
- `web` - Nginx on port 8000
- `db` - MySQL 8.0 on port 3306 (DB: laravel, user: laravel/password)
- `mailhog` - Email testing on ports 1025/8025

**Working Directory**: All Laravel code is in `./src/`, mounted to `/var/www/html` in containers.

### Application Structure

```
src/
├── app/
│   ├── Http/Controllers/    # Controllers
│   ├── Models/              # Eloquent models
│   └── Providers/           # Service providers
├── resources/
│   ├── js/
│   │   ├── app.js          # Vue entry point
│   │   └── bootstrap.js    # Axios setup
│   └── css/app.css         # Tailwind entry
├── routes/web.php          # Web routes
└── database/migrations/    # Database migrations
```

**Key Patterns**:
- **Frontend**: Vue 3 with Vite hot-reload, Tailwind CSS 4 with Vite plugin
- **Backend**: Standard Laravel 12 structure
- **Database**: Migration-based schema (users, profiles, user_parts, user_genres)

### Development Workflow

This project follows a **mock-first implementation** approach:

1. **Create controller** with mock data method
2. **Build Vue page** implementing Figma designs
3. **Define route** in `routes/web.php`
4. **Replace mock data** with real Eloquent queries

Example controller pattern:
```php
// Phase 1: Mock data
return Inertia::render('Members/Index', [
    'members' => $this->getMockData()
]);

// Phase 2: Real data (uncomment later)
// 'members' => Member::paginate(20)
```

## Development Commands

### Docker Operations
```bash
# Start environment
docker compose up -d

# Stop environment
docker compose down

# Execute commands in app container
docker compose exec app php artisan [command]
docker compose exec app composer [command]

# View logs
docker compose logs -f app
```

### Laravel Development
```bash
# Run migrations
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:fresh  # Reset database

# Generate application key
docker compose exec app php artisan key:generate

# Create symbolic link for storage
docker compose exec app php artisan storage:link

# Clear caches
docker compose exec app php artisan config:clear
docker compose exec app php artisan route:clear
docker compose exec app php artisan view:clear
```

### Frontend Development
```bash
# Install dependencies
docker compose exec app npm install

# Development server (hot-reload)
docker compose exec app npm run dev

# Production build
docker compose exec app npm run build
```

### Testing
```bash
# Run all tests (uses SQLite in-memory)
docker compose exec app php artisan test

# Run specific test
docker compose exec app php artisan test --filter=TestName

# Run tests with coverage
docker compose exec app php artisan test --coverage
```

### Code Quality
```bash
# Laravel Pint (code formatting)
docker compose exec app ./vendor/bin/pint

# Run Pint on specific files
docker compose exec app ./vendor/bin/pint path/to/file.php
```

## Access URLs

- Application: http://localhost:8000
- MailHog UI: http://localhost:8025
- MySQL: localhost:3306 (laravel/password)

## Database Configuration

Test environment uses SQLite in-memory (phpunit.xml). Development uses MySQL container.

**MySQL Connection**:
- Host: db (container name)
- Port: 3306
- Database: laravel
- User: laravel
- Password: password

## Important Notes

- **All Laravel commands** must be run inside the `app` container using `docker compose exec app`
- **Working directory** is `./src/` for source code, not root
- **No Sail**: This project uses custom Docker Compose, not Laravel Sail
- **Japanese language**: UI and content are in Japanese
- **Mock-first**: Implement UI with mock data before integrating real database queries
- **Vue 3**: Uses Composition API pattern (not Options API)
- **Tailwind 4**: Uses new Vite plugin (`@tailwindcss/vite`)

## Composer Scripts

The project defines these convenience scripts in `composer.json`:
- `composer setup` - Full project setup (install, migrate, build)
- `composer dev` - Start development environment with concurrent servers
- `composer test` - Clear config and run tests
