# Copilot Instructions for proyectoexcernat

## Overview
This monorepo contains a Laravel backend (`back/`) and a Vue 3 + Vite frontend (`front/`). The backend and frontend are developed and run independently, but are designed to work together as a full-stack application.

## Architecture
- **Backend (`back/`)**: Laravel 10+ application. Contains HTTP controllers, Eloquent models, migrations, seeders, and API routes. Uses `resources/views` for Blade templates, but most UI is handled by the frontend.
- **Frontend (`front/`)**: Vue 3 app scaffolded with Vite. Uses Single File Components (`.vue`) and `src/components/` for UI. Communicates with the backend via HTTP API calls.

## Key Workflows
- **Backend**
  - Start local server: `php artisan serve` (from `back/`)
  - Run tests: `php artisan test` or `vendor\bin\pest` (Pest is available)
  - Migrate DB: `php artisan migrate`
  - Seed DB: `php artisan db:seed`
- **Frontend**
  - Start dev server: `npm install && npm run dev` (from `front/`)
  - Build for production: `npm run build`

## Project Conventions
- **Backend**
  - Models in `app/Models/`, controllers in `app/Http/Controllers/`, migrations in `database/migrations/`.
  - Use Eloquent ORM for DB access. See `Producto.php`, `Categoria.php` for examples.
  - API routes in `routes/api.php`, web routes in `routes/web.php`.
  - Use Pest for tests (`tests/Feature/`, `tests/Unit/`).
- **Frontend**
  - Main entry: `src/main.js`, root component: `src/App.vue`.
  - Components in `src/components/`.
  - Use `fetch` or `axios` for API calls to backend.

## Integration Points
- The frontend communicates with the backend via RESTful API endpoints defined in `back/routes/api.php`.
- CORS may need to be configured in `back/config/cors.php` for local development.
- Static assets for the frontend are served from `front/public/`.

## Examples
- To add a new API resource, create a model and migration in `back/app/Models/` and `back/database/migrations/`, a controller in `back/app/Http/Controllers/`, and register routes in `back/routes/api.php`.
- To add a new UI view, create a `.vue` component in `front/src/components/` and import it in `front/src/App.vue` or another parent component.

## Tips for AI Agents
- Prefer existing patterns for controllers, models, and Vue components.
- When in doubt, check for similar files (e.g., `Producto.php`, `Categoria.php`, or `ExampleTest.php`).
- Keep backend and frontend logic separated; use API calls for cross-boundary communication.
- Use Pest for new tests in the backend.

---
For more details, see `back/README.md` and `front/README.md`.
