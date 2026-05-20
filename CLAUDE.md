# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

WJPF (World Jigsaw Puzzle Federation) is a PHP-based web application for managing an international jigsaw puzzle association — member associations, users, appointments (competitions), and world championships.

**Tech Stack:**
- Backend: PHP (procedural, no framework), MySQL/MariaDB
- Frontend: Bootstrap 5.3.1, DataTables 1.13.6 (server-side processing)
- Symfony Mailer 6.4, html2pdf 5.2, DeepL API 1.7, Monolog 3.5, PHPUnit, PHPStan

## Setup

```bash
composer install

# Edit includes/settings/config.php (gitignored — create manually):
# DB_HOST, DB_USER, DB_PASSWORD, DB_NAME
# TEST_EMAIL (redirects all outgoing mail in dev), TEST_EMAIL_INTRO (subject prefix)

mysql -u root wjpf < database/tables.sql
mysql -u root wjpf < database/admin.sql
mysql -u root wjpf < database/countries.sql
```

Serve via XAMPP (Apache + MySQL) at `http://localhost/wjpf/` or `php -S localhost:8000`.

## Running Tests / Static Analysis

```bash
./vendor/bin/phpunit tests/
./vendor/bin/phpunit tests/SomeTest.php

./vendor/bin/phpstan analyse includes/ --level 5
```

## Architecture

### Request Flow

Every page includes `header.php` → `init.php`, which:
- Starts session, sets timezone to `Europe/Berlin`
- Loads composer autoload, config, DB connection, all `includes/functions_*.php`, mail setup

`nav_base.php` renders the navbar. `footer.php` closes the page.

DataTable endpoints (`datatable/get_*.php`) must call `chdir('..')` before including `init.php`.

### Admin DataTables Flow

Admin pages (`admin_*.php`) render an HTML table; user interactions trigger AJAX to `datatable/get_*.php`, which uses `SSP::complex()` to build paginated/sorted SQL and returns JSON. Columns arrays in those files define HTML formatters for cell rendering.

### Authentication & Authorization

- Login: `validate_user_login()` in `functions_user.php` — `password_verify()`, status must be ACTIVE (3) or CONFIRMATION (2), sets `$_SESSION['user']` to user ID.
- `logged_in()`, `user_is_admin()`, `user_is_board_user()` (board_role > 1), `CheckUserLogin()`, `CheckBoardUserOrAdmin()`
- Password reset: time-limited key (1 hour), bcrypt cost=12, CSRF tokens via `token_generator()`

### Database Patterns

Global `$con` from `db.php`. Wrappers: `query()`, `query_array()`, `query_row()`. Manual SQL with string interpolation — always use `escape()` after `decode()` on user input. Transactions: `sql_begin()`, `sql_commit()`, `sql_rollback()`.

Entity loaders (`get_user($id)`, `get_association($id)`, `get_appointment($id)`) fetch the record, resolve country name, and set a default image if none exists.

### Key Tables

| Table | Purpose |
|---|---|
| `user` | Board members/admins — credentials, bcrypt password, board_role, image |
| `association` | Member orgs — type (national/continental/federation/company), membership dates |
| `association_admin` | Many-to-many: users administering associations |
| `appointment` | Competitions/events — location with lat/lng for map display |
| `settings` | SMTP config, email recipients, bank account info |

Constants for statuses/types/roles are in `includes/defines.php`.

### Internationalization

Language in `$_SESSION['language']` (default: `de`). Switch via `?language=en`. Country names use `get_country_name($code, $language)`.

### Email

`send_html_mail()` / `send_text_mail()` in `includes/mail.php`. SMTP settings come from the `settings` table. In dev, `TEST_EMAIL` intercepts all mail.

### Image Handling

`includes/functions_image.php` uploads and resizes to multiple sizes (thumb/medium/large/extra_large). Paths stored in DB, files on disk. Default fallback: `img/boss.png`.

## Adding New Entities / Admin Pages

1. Add table to `database/tables.sql`; schema changes go in `database/update.sql` (applied manually — no migration system).
2. Add CRUD functions in `includes/functions_something.php` following the `get_*()` / `create_*()` / `update_*()` / `delete_*()` pattern.
3. Create `admin_something.php` — call `CheckBoardUserOrAdmin()` at top.
4. Create `datatable/get_something.php` with columns array + `SSP::complex()`.
5. Add nav link in `includes/nav_base.php`.
6. Add status/type constants to `includes/defines.php`.
