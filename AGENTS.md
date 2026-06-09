# AGENTS.md — Laravel 13 Skeleton

This is a stock Laravel 13 scaffold. No custom app code yet.

## Commands

| Task | Command | Notes |
|------|---------|-------|
| Run tests | `composer test` | Runs `config:clear` then `php artisan test` |
| Single test | `php artisan test tests/Feature/ExampleTest.php` | Or `vendor/bin/phpunit ...` |
| Lint PHP | `./vendor/bin/pint` | Laravel Pint, auto-diffs |
| Dev servers | `composer dev` | Server + queue + logs + Vite via concurrently |
| Vite build | `npm run build` | |
| Full setup | `composer setup` | Composer install → .env → key → migrate → npm → build |

## Database

- SQLite everywhere. Dev: `database/database.sqlite`. Tests: `:memory:` (see `phpunit.xml`).
- No external DB required. Tests run with no setup.
- Feature tests: use `RefreshDatabase` trait when tests touch the DB.
- Migrations: users, cache, jobs (`database/migrations/`).

## Structure

- `app/` — PSR-4 `App\` namespace. Uses PHP 8 attributes (`#[Fillable]`, `#[Hidden]`).
- `routes/web.php` — web routes. `routes/console.php` — Artisan commands. No `api.php` yet.
- `tests/Feature/` — integration tests (HTTP, DB). `tests/Unit/` — plain PHPUnit.
- `bootstrap/app.php` — framework wiring (routing, middleware, exception handling).
- Config in `config/`. Session, cache, and queue default to `database` driver.

## Conventions

- `.env.example` → `.env` for new installs (via `composer setup` or `post-root-package-install`).
- `.npmrc` sets `ignore-scripts=true`; `composer setup` passes `--ignore-scripts` to npm.
- End of line: LF. Indent: 4 spaces (PHP/JS), 2 spaces (YAML).
- No CI, no pre-commit hooks, no API routes defined. Build from here.
