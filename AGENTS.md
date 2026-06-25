# AGENTS.md

Laravel 13 web app — webinar platform with admin panel, speakers, testimonials. Started from skeleton, now has custom code.

## Commands

| Task | Command | Notes |
|------|---------|-------|
| Run tests | `composer test` | Runs `config:clear` then `php artisan test` |
| Single test | `php artisan test tests/Feature/ExampleTest.php` | Or `vendor/bin/phpunit ...` |
| Lint PHP | `./vendor/bin/pint` | Laravel Pint |
| Dev servers | `composer dev` | Server + queue + logs + Vite via concurrently |
| Vite build | `npm run build` | |
| Full setup | `composer setup` | Composer install → .env → key → migrate → npm → build |

## Database

- Dev: SQLite (`database/database.sqlite`). Tests: `:memory:` (see `phpunit.xml`).
- Production on Render: PostgreSQL (`render.yaml` config).
- Feature tests touching DB: use `RefreshDatabase` trait.
- `env.txt` is reference copy of `.env.example` (not loaded by Laravel). `.env` is gitignored.

## Auth

- Session-based login (no API tokens, no Sanctum/Sanctum). Routes in `routes/web.php`.
- Login throttled: `throttle:5,1` (5 attempts per minute).
- Admin routes behind `auth` middleware group.

## App structure

- `routes/web.php` — all routes (no `api.php`). Public: `/`, `/webinars`, `/webinar/{id}`, `/contact`, `/login`.
- Models: User, Webinar, Speaker, Testimonial, ContactSetting (`app/Models/`).
- Controllers: AdminController (CRUD for all entities), AuthController, WebinarController (`app/Http/Controllers/`).
- `app/helpers.php` — `storage_url()` and `storage_url_base()` (autoloaded by composer).
- Middleware: `SecurityHeaders` appended globally in `bootstrap/app.php`; `trustProxies(at: '*')` set.

## Model conventions

- **User model** uses PHP 8 attributes: `#[Fillable]`, `#[Hidden]`.
- **Other models** use traditional `protected $fillable = [...]`. Keep both styles as-is.
- Webinar speakers stored as JSON array (casts to `'array'`).
- BOOLEAN fields handled via `$request->boolean('field')` in controllers.
- Scopes: `scopeActive($query)` on Webinar, Speaker, Testimonial.

## File uploads

- Image max: 5 MB. Allowed: `jpeg,png,jpg,gif,webp`.
- Stored via `$file->store('subdir', $disk)` where disk = `env('FILESYSTEM_DISK', 'public')`.
- `public` disk uses `storage/app/public/` symlink. S3 used in production.

## Deployment (Render)

- `render.yaml` describes web service + PostgreSQL 16. Build: install no-dev, cache events/routes/views.
- Caching commands: `event:cache`, `route:cache`, `view:cache`.

## Style & config

- `.editorconfig`: LF, 4-space PHP/JS, 2-space YAML.
- `.npmrc`: `ignore-scripts=true` — npm install won't run lifecycle scripts.
- Vite: TailwindCSS v4 (`@tailwindcss/vite` plugin), Alpine.js. Inputs: `resources/css/app.css`, `resources/css/home.css`, `resources/js/app.js`.
- Vue/React not used — plain Blade + Alpine.js.
