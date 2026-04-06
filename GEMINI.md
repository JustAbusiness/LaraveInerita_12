# GEMINI.md

## Project Overview
This is a modern web application built with **Laravel 12** and **Inertia.js 2.0**, using **React 19** (TypeScript) for the frontend. It follows a clean architecture by incorporating Repository and Service patterns to separate data access and business logic.

### Main Technologies
- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** React 19, TypeScript, Inertia.js 2.0
- **Styling:** Tailwind CSS 4, Radix UI, Lucide React
- **Authentication:** Laravel Fortify
- **Testing:** Pest (PHP), Vitest/Playwright (Potential for JS, though not explicitly configured in `package.json` yet)
- **Tooling:** Vite, ESLint, Prettier, TypeScript

## Project Structure
- `app/Repositories/`: Contains data access logic (e.g., `BaseRepo`, `UserCatalogueRepo`).
- `app/Services/`: Contains business logic layer (e.g., `Interfaces/BaseServiceInteface`).
- `app/Models/`: Eloquent models (e.g., `User`, `UserCatalogue`).
- `resources/js/pages/`: Inertia React page components.
- `resources/js/components/`: Reusable React components (includes Radix UI primitives in `ui/`).
- `resources/js/layouts/`: Layout components (App, Auth, Settings).
- `routes/`: Web and API routes, including modularized routes in `routes/route/`.

## Building and Running

### Development Environment
The easiest way to start the development environment is using the composer script:
```bash
composer dev
```
This command concurrently runs:
- PHP Artisan Server (`php artisan serve`)
- Queue Listener (`php artisan queue:listen`)
- Laravel Pail (log monitoring)
- Vite Dev Server (`npm run dev`)

### Other Key Commands
- **Setup Project:** `composer run setup` (runs migrations, installs dependencies, builds assets)
- **Install Dependencies:** `composer install` and `npm install`
- **Build Assets:** `npm run build`
- **Run Tests:** `composer test` or `php artisan test`
- **Linting & Formatting:**
  - `npm run lint`: Lint and fix JavaScript/TypeScript.
  - `npm run format`: Format resources with Prettier.
  - `npm run types`: Run TypeScript type checking.
- **Database:** `php artisan migrate`

## Development Conventions

### Backend
- **Repository Pattern:** Use repositories in `app/Repositories` for Eloquent queries to keep models lean.
- **Service Pattern:** Business logic should reside in `app/Services`. Services should ideally implement interfaces from `app/Services/Interfaces`.
- **Naming Conventions:** Standard Laravel PSR-4 naming. Controllers are organized into `Backend`, `Frontend`, and `Settings` namespaces.

### Frontend
- **TypeScript:** All new frontend code should be written in TypeScript (`.tsx` or `.ts`).
- **Components:** Reusable UI components are located in `resources/js/components/ui/`.
- **Inertia Pages:** Pages are located in `resources/js/pages/`.
- **Styling:** Use Tailwind CSS 4 utility classes.
- **State Management:** Use Inertia's built-in state management and React hooks.

### Testing
- Use **Pest** for backend testing.
- New features should include corresponding test cases in `tests/Feature/`.
