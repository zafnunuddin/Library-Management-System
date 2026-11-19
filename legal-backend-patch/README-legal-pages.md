# Terms of Use / Privacy Policy Backend

Adds a database-backed, admin-editable Terms of Use and Privacy Policy to the
Library Management System, and wires them into the login/register page links
that were previously `href="#"`.

## What was added

| File | Purpose |
|---|---|
| `database/migrations/2026_08_21_000001_create_legal_pages_table.php` | New `legal_pages` table: `slug`, `title`, `content`, `version`, `updated_by`. |
| `app/Models/LegalPage.php` | Eloquent model + `findBySlug()` helper. |
| `database/seeders/LegalPageSeeder.php` | Seeds default Terms and Privacy Policy content. |
| `app/Http/Controllers/LegalController.php` | Public controller — `show()` renders a page by slug (also returns JSON if requested). |
| `app/Http/Controllers/Admin/LegalPageController.php` | Admin-only CRUD: `index`, `edit`, `update`. |
| `resources/views/legal/show.blade.php` | Public page that displays Terms/Privacy content. |
| `resources/views/admin/legal/index.blade.php` | Admin list screen. |
| `resources/views/admin/legal/edit.blade.php` | Admin edit form (title + HTML content textarea). |
| `routes/web.php` | New routes (see below). Merge this with your current file if you've changed it since. |
| `resources/views/auth/login.blade.php` | `Terms` / `Privacy Policy` links now point to real routes. |
| `resources/views/auth/register.blade.php` | Same fix on the registration page. |
| `resources/views/layouts/sidebar.blade.php` | Added a "Legal Pages" link to the admin sidebar. |

## Routes

Public (no login required):
- `GET /terms` → named `terms`
- `GET /privacy-policy` → named `privacy`

Admin only (`auth` + `admin` middleware, already used elsewhere in the app):
- `GET /admin/legal-pages` → named `admin.legal.index`
- `GET /admin/legal-pages/{slug}/edit` → named `admin.legal.edit`
- `PUT /admin/legal-pages/{slug}` → named `admin.legal.update`

## Setup

1. Copy these files into your project (same relative paths), merging
   `routes/web.php` if you've made other changes to it since this patch.
2. Run the migration:
   ```
   php artisan migrate
   ```
3. Seed default content:
   ```
   php artisan db:seed --class=LegalPageSeeder
   ```
   (It's also registered in `DatabaseSeeder`, so a fresh `php artisan migrate:fresh --seed` will include it.)
4. Visit `/terms` and `/privacy-policy` to confirm they render.
5. Log in as an admin → sidebar → **Legal Pages** → **Edit** to change the content.

## Notes

- Content is stored as raw HTML and rendered with `{!! !!}` (unescaped) on the
  public page, so only trusted admins should have access to the edit screen —
  that's why the admin routes are protected by both `auth` and `admin`
  middleware, not just `auth` like some of the other admin routes in this app.
- `version` increments on every save and `updated_by` records which admin
  last edited it, in case you want an audit trail later.
- If you'd rather use a WYSIWYG editor instead of a raw HTML textarea in
  `admin/legal/edit.blade.php`, swap the `<textarea>` for something like
  TinyMCE/Quill — the backend doesn't need to change.
