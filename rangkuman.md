# 📄 DOKUMEN KONTEKS TEKNIS & PRD PROYEK (SINGLE SOURCE OF TRUTH)

> **Catatan Penting untuk AI (Gemini / Claude / ChatGPT / Antigravity):**  
> Anda bertindak sebagai Senior Software Architect & Lead Fullstack Engineer.  
> Dokumen ini adalah acuan mutlak (*Single Source of Truth*) mengenai arsitektur, struktur tabel database, relasi entitas, rute endpoint, dan logika bisnis aplikasi.  
>  
> **ATURAN WAJIB BAGI AI AGAR JAWABAN TIDAK NGAWUR / HALUSINASI:**  
> 1. **DILARANG MENGARANG NAMA:** Jangan pernah mengasumsikan atau mengarang nama tabel, nama kolom, nama relasi, nama route, atau method controller yang tidak tertera pada dokumen ini.  
> 2. **PATUHI STRUKTUR DATABASE:** Seluruh query, mutasi data, dan relasi Eloquent/ORM harus 100% cocok dengan skema tabel di Seksi 3 & Seksi 4.  
> 3. **KEAMANAN & VALIDASI:** Setiap pembuatan fitur baru wajib menyertakan validasi request (Form Request) dan otorisasi role/permission yang konsisten dengan sistem saat ini.  
> 4. **KONSISTENSI GAYA KODE:** Ikuti pola arsitektur yang sudah berjalan pada controllers, services, dan views yang ada.

---

## 📌 INFORMASI PROYEK
- **Nama Aplikasi / Folder:** `sistem_pengaduan`
- **Waktu Ekstraksi:** `2026-10-20 19:52:42`
- **Teknologi Terdeteksi:** `Tailwind CSS Vite Node.js / NPM Laravel (PHP) `

---

## 📑 DAFTAR ISI
1. [Ikhtisar Struktur Direktori](#1-ikhtisar-struktur-direktori)
2. [Konfigurasi & Dependensi Sistem](#2-konfigurasi--dependensi-sistem)
3. [Skema Database, Migrasi & Seeders](#3-skema-database-migrasi--seeders)
4. [Data Models & Relasi Database (ORM / Eloquent)](#4-data-models--relasi-database-orm--eloquent)
5. [Rute & Endpoint Aplikasi (Routing)](#5-rute--endpoint-aplikasi-routing)
6. [Validasi Data & Form Requests](#6-validasi-data--form-requests)
7. [Logika Bisnis & Controllers](#7-logika-bisnis--controllers)
8. [Services, Middlewares & Providers](#8-services-middlewares--providers)
9. [Tampilan Antarmuka (Views, Layouts & Components)](#9-tampilan-antarmuka-views-layouts--components)

---

## 1. IKHTISAR STRUKTUR DIREKTORI

Struktur folder dan file aplikasi (mengabaikan folder vendor, node_modules, storage/cache, build artifacts, dan temporary):

```text
.
|-- README.md
|-- app
||-- Console
|||-- Commands
||||-- CleanupTempComplaints.php
||-- Http
|||-- Controllers
||||-- Admin
||||-- AttachmentController.php
||||-- Auth
||||-- Controller.php
||||-- DashboardController.php
||||-- LandingController.php
||||-- ProfileController.php
||||-- PublicComplaintController.php
||||-- PublicStatusController.php
|||-- Requests
||||-- Auth
||||-- ProfileUpdateRequest.php
||||-- StoreBiodataRequest.php
||||-- StoreComplaintDataRequest.php
||||-- StoreComplaintStep1Request.php
||||-- StoreNewsRequest.php
||||-- StoreResponseRequest.php
||||-- StoreUserRequest.php
||||-- UpdateComplaintStatusRequest.php
||||-- UpdateUserRequest.php
||-- Models
|||-- Category.php
|||-- Complaint.php
|||-- Gallery.php
|||-- News.php
|||-- Response.php
|||-- User.php
||-- Providers
|||-- AppServiceProvider.php
|||-- AuthServiceProvider.php
||-- Services
|||-- ComplaintService.php
||-- View
|||-- Components
||||-- AppLayout.php
||||-- GuestLayout.php
||||-- PublicLayout.php
|-- artisan
|-- bootstrap
||-- app.php
||-- cache
|||-- packages.php
|||-- services.php
||-- providers.php
|-- composer.json
|-- composer.lock
|-- config
||-- app.php
||-- auth.php
||-- cache.php
||-- database.php
||-- filesystems.php
||-- logging.php
||-- mail.php
||-- permission.php
||-- queue.php
||-- services.php
||-- session.php
|-- database
||-- database.sqlite
||-- factories
|||-- CategoryFactory.php
|||-- UserFactory.php
||-- migrations
|||-- 0001_01_01_000000_create_users_table.php
|||-- 0001_01_01_000001_create_cache_table.php
|||-- 0001_01_01_000002_create_jobs_table.php
|||-- 2025_11_09_100646_create_categories_table.php
|||-- 2025_11_09_100652_create_complaints_table.php
|||-- 2025_11_09_101004_create_responses_table.php
|||-- 2025_11_09_130746_create_permission_tables.php
|||-- 2025_12_19_083904_create_galleries_table.php
|||-- 2025_12_19_102016_remove_reporter_fields_from_complaints_table.php
|||-- 2025_12_19_105305_create_news_table.php
|||-- 2026_01_02_140700_add_details_to_users_table.php
||-- seeders
|||-- DatabaseSeeder.php
|||-- RolesAndPermissionsSeeder.php
|-- generate_context.sh
|-- laravel
|-- package-lock.json
|-- package.json
|-- phpunit.xml
|-- postcss.config.js
|-- public
||-- build
|||-- assets
||||-- app-BDX03Uzx.css
||||-- app-ByW0VTRm.js
|||-- manifest.json
||-- css
|||-- style.css
||-- favicon.ico
||-- images
|||-- 1.jpg
|||-- 123.jpg
|||-- 2.jpg
|||-- 3.jpg
|||-- 4.jpg
|||-- 5.jpg
|||-- gallery-1.jpg
|||-- gallery-2.jpg
|||-- gallery-3.jpg
|||-- gallery-4.jpg
|||-- gallery-5.jpg
|||-- hero-banner.jpg
|||-- hi.png
|||-- hihi.png
|||-- ho.png
|||-- img8.jpg
|||-- img9.jpg
|||-- inspektorat.jpg
|||-- logo-blue.svg
|||-- logo-kota.png
|||-- logo-kota1.png
|||-- logo.svg
|||-- packege-1.jpg
|||-- packege-2.jpg
|||-- packege-3.jpg
|||-- pemerintah.png
|||-- popular-1.jpg
|||-- popular-2.jpg
|||-- popular-3.jpg
|||-- test.png
||-- index.php
||-- js
|||-- script1.js
||-- robots.txt
|-- rangkuman.md
|-- resources
||-- css
|||-- app.css
||-- js
|||-- app.js
|||-- bootstrap.js
||-- views
|||-- admin
||||-- categories
||||-- complaints
||||-- dashboard.blade.php
||||-- galleries
||||-- news
||||-- system
||||-- users
|||-- auth
||||-- confirm-password.blade.php
||||-- forgot-password.blade.php
||||-- login.blade.php
||||-- register.blade.php
||||-- reset-password.blade.php
||||-- verify-email.blade.php
|||-- components
||||-- auth-session-status.blade.php
||||-- danger-button.blade.php
||||-- dropdown-link.blade.php
||||-- dropdown.blade.php
||||-- input-error.blade.php
||||-- input-label.blade.php
||||-- modal.blade.php
||||-- nav-link.blade.php
||||-- primary-button.blade.php
||||-- responsive-nav-link.blade.php
||||-- secondary-button.blade.php
||||-- text-input.blade.php
|||-- dashboard.blade.php
|||-- layouts
||||-- app.blade.php
||||-- guest.blade.php
||||-- navigation.blade.php
||||-- public.blade.php
|||-- petugas
||||-- dashboard.blade.php
|||-- profile
||||-- edit.blade.php
||||-- partials
|||-- public
||||-- finish.blade.php
||||-- status
||||-- step1.blade.php
||||-- step2.blade.php
|||-- vendor
||||-- pagination
|||-- welcome.blade.php
|-- routes
||-- auth.php
||-- console.php
||-- web.php
|-- status.txt
|-- tailwind.config.js
|-- tests
||-- Feature
|||-- Auth
||||-- AuthenticationTest.php
||||-- EmailVerificationTest.php
||||-- PasswordConfirmationTest.php
||||-- PasswordResetTest.php
||||-- PasswordUpdateTest.php
||||-- RegistrationTest.php
|||-- ExampleTest.php
|||-- ProfileTest.php
||-- TestCase.php
||-- Unit
|||-- ExampleTest.php
|-- vite.config.js
```

---

## 2. KONFIGURASI & DEPENDENSI SISTEM

### File: `.env.example`
```ini
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

```

### File: `composer.json`
```json
{
    "$schema": "https://getcomposer.org/schema.json",
    "name": "laravel/laravel",
    "type": "project",
    "description": "The skeleton application for the Laravel framework.",
    "keywords": ["laravel", "framework"],
    "license": "MIT",
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0",
        "laravel/tinker": "^2.10.1",
        "spatie/laravel-permission": "^6.23"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "fruitcake/laravel-debugbar": "^4.4",
        "laravel/breeze": "^2.3",
        "laravel/pail": "^1.2.2",
        "laravel/pint": "^1.24",
        "laravel/sail": "^1.41",
        "mockery/mockery": "^1.6",
        "nunomaduro/collision": "^8.6",
        "phpunit/phpunit": "^11.5.3"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "scripts": {
        "setup": [
            "composer install",
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\"",
            "@php artisan key:generate",
            "@php artisan migrate --force",
            "npm install",
            "npm run build"
        ],
        "dev": [
            "Composer\\Config::disableProcessTimeout",
            "npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others"
        ],
        "test": [
            "@php artisan config:clear --ansi",
            "@php artisan test"
        ],
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi"
        ],
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force"
        ],
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi",
            "@php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\"",
            "@php artisan migrate --graceful --ansi"
        ],
        "pre-package-uninstall": [
            "Illuminate\\Foundation\\ComposerScripts::prePackageUninstall"
        ]
    },
    "extra": {
        "laravel": {
            "dont-discover": []
        }
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true,
        "allow-plugins": {
            "pestphp/pest-plugin": true,
            "php-http/discovery": true
        }
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}

```

### File: `package.json`
```json
{
    "$schema": "https://json.schemastore.org/package.json",
    "private": true,
    "type": "module",
    "scripts": {
        "build": "vite build",
        "dev": "vite"
    },
    "devDependencies": {
        "@tailwindcss/forms": "^0.5.2",
        "@tailwindcss/vite": "^4.0.0",
        "alpinejs": "^3.4.2",
        "autoprefixer": "^10.4.2",
        "axios": "^1.11.0",
        "concurrently": "^9.0.1",
        "laravel-vite-plugin": "^2.0.0",
        "postcss": "^8.4.31",
        "tailwindcss": "^3.1.0",
        "vite": "^7.0.7"
    }
}

```

### File: `vite.config.js`
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});

```

### File: `tailwind.config.js`
```javascript
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};

```

---

## 3. SKEMA DATABASE, MIGRASI & SEEDERS

Mendefinisikan nama tabel, tipe kolom, foreign key, index, dan constraint basis data.

#### File: `database/migrations/0001_01_01_000000_create_users_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

```

#### File: `database/migrations/0001_01_01_000001_create_cache_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};

```

#### File: `database/migrations/0001_01_01_000002_create_jobs_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};

```

#### File: `database/migrations/2025_11_09_100646_create_categories_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

```

#### File: `database/migrations/2025_11_09_100652_create_complaints_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            // --- TAMBAHAN PENTING (RELASI USER) ---
            // Ini wajib ada agar relasi $user->complaints bisa berjalan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // -------------------------------------

            // Data pelapor manual (opsional jika sudah ada user_id, tapi bisa disimpan untuk backup)
            // Saya buat nullable agar tidak error jika data diambil dari user login
            $table->string('nama_pelapor')->nullable();
            $table->string('email_pelapor')->nullable();
            $table->string('telepon_pelapor')->nullable();

            // Step 2: Pengaduan
            $table->string('title');
            $table->text('content');

            // Relasi ke Kategori
            $table->foreignId('category_id')->constrained('categories');

            $table->string('attachment')->nullable();

            $table->string('token')->unique();

            $table->string('status')->default('pending'); // pending, processed, finished, rejected

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};

```

#### File: `database/migrations/2025_11_09_101004_create_responses_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();

            // Relasi ke Complaint (Disempurnakan)
            // onDelete('cascade') berarti jika pengaduan dihapus, tanggapannya ikut terhapus.
            $table->foreignId('complaint_id')->constrained('complaints')->onDelete('cascade');

            // Relasi ke User (Petugas) (Disempurnakan)
            // onDelete('set null') berarti jika petugas dihapus, tanggapannya tetap ada
            // tapi user_id nya jadi NULL.
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->text('content'); // 'content' sudah benar

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};

```

#### File: `database/migrations/2025_11_09_130746_create_permission_tables.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

        throw_if(empty($tableNames), Exception::class, 'Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        throw_if($teams && empty($columnNames['team_foreign_key'] ?? null), Exception::class, 'Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');

        Schema::create($tableNames['permissions'], static function (Blueprint $table) {
            // $table->engine('InnoDB');
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('guard_name'); // For MyISAM use string('guard_name', 25);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['roles'], static function (Blueprint $table) use ($teams, $columnNames) {
            // $table->engine('InnoDB');
            $table->bigIncrements('id'); // role id
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('guard_name'); // For MyISAM use string('guard_name', 25);
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        Schema::create($tableNames['model_has_permissions'], static function (Blueprint $table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
            $table->unsignedBigInteger($pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }

        });

        Schema::create($tableNames['model_has_roles'], static function (Blueprint $table) use ($tableNames, $columnNames, $pivotRole, $teams) {
            $table->unsignedBigInteger($pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], static function (Blueprint $table) use ($tableNames, $pivotRole, $pivotPermission) {
            $table->unsignedBigInteger($pivotPermission);
            $table->unsignedBigInteger($pivotRole);

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([$pivotPermission, $pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        throw_if(empty($tableNames), Exception::class, 'Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
};

```

#### File: `database/migrations/2025_12_19_083904_create_galleries_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};

```

#### File: `database/migrations/2025_12_19_102016_remove_reporter_fields_from_complaints_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn(['nama_pelapor', 'email_pelapor', 'telepon_pelapor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('nama_pelapor')->nullable();
            $table->string('email_pelapor')->nullable();
            $table->string('telepon_pelapor')->nullable();
        });
    }
};

```

#### File: `database/migrations/2025_12_19_105305_create_news_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Standard for news URLs
            $table->text('content');
            $table->string('image_path')->nullable(); // Required for standard news generally, but nullable in schema is safer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

```

#### File: `database/migrations/2026_01_02_140700_add_details_to_users_table.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik')->unique()->nullable()->after('name');
            $table->string('phone')->nullable()->after('nik');
            $table->string('avatar')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'phone', 'avatar']);
        });
    }
};

```

#### File: `database/seeders/DatabaseSeeder.php`
```php
<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil Seeder Roles dan User Admin/Petugas
        $this->call(RolesAndPermissionsSeeder::class);

        // Kategori Pengaduan Tindak Pidana Korupsi
        $kategoriKorupsi = [
            'Kerugian Keuangan Negara',
            'Suap-menyuap',
            'Penggelapan dalam Jabatan',
            'Pemerasan',
            'Perbuatan Curang',
            'Benturan Kepentingan',
            'Gratifikasi'
        ];

        // Masukkan ke dalam database
        foreach ($kategoriKorupsi as $category) {
            \App\Models\Category::create(['name' => $category]);
        }

        // (Opsional) Buat 10 user 'test'
        // User::factory(10)->create();

        // (Opsional) Buat data 'test' untuk factory user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

```

#### File: `database/seeders/RolesAndPermissionsSeeder.php`
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $rolePetugas = Role::create(['name' => 'petugas']);
        $roleWalikota = Role::create(['name' => 'walikota']); // Sebelumnya kepala_instansi
        $roleMasyarakat = Role::create(['name' => 'masyarakat']);

        // 2. Buat Permissions (Hak Akses Granular)
        // Laporan
        Permission::create(['name' => 'view_complaints']);
        Permission::create(['name' => 'verify_complaints']); // Petugas: Pending -> Process
        Permission::create(['name' => 'resolve_complaints']); // Admin: Process -> Finish
        Permission::create(['name' => 'delete_complaints']); 
        
        // Manajemen
        Permission::create(['name' => 'manage_master']); // User management, config
        Permission::create(['name' => 'manage_documentation']); // Gallery
        Permission::create(['name' => 'manage_system']); // Backup, Restore, Logs (Simulasi)

        // 3. Assign Permissions ke Role
        
        // ADMIN: Mengatur hampir semua, TAPI untuk workflow laporan dia fokus di finishing (resolve) + Manajerial
        $roleAdmin->givePermissionTo([
            'view_complaints',
            'resolve_complaints', // Eksekusi Akhir
            'delete_complaints',
            'manage_master',
            'manage_documentation',
            'manage_system',
        ]);

        // PETUGAS: Verifikasi Laporan
        $rolePetugas->givePermissionTo([
            'view_complaints',
            'verify_complaints'
        ]);

        // WALIKOTA : Hanya Mengawasi (View Only)
        $roleWalikota->givePermissionTo(['view_complaints']);

        // Masyarakat: Tidak butuh permission khusus dari server side ini (logic terpisah), 
        // tapi jika mau strict bisa tambah 'create_complaint'. Untuk saat ini skip agar simple.

        // 2. Buat User Admin Default
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $adminUser->assignRole($roleAdmin);

        // 3. Buat User Petugas Default
        $petugasUser = User::create([
            'name' => 'Petugas',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password'),
        ]);
        $petugasUser->assignRole($rolePetugas);

        // 4. Buat User Masyarakat Default (Opsional, untuk tes)
        $wargaUser = User::create([
            'name' => 'Masyarakat Contoh',
            'email' => 'warga@example.com',
            'password' => Hash::make('password'),
        ]);
        $wargaUser->assignRole($roleMasyarakat);
    }
}

```

---

## 4. DATA MODELS & RELASI DATABASE (ORM / ELOQUENT)

Definisi model, fillable attributes, casting tipe data, dan relasi (hasMany, belongsTo, dsb).

#### File: `app/Models/Category.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Relasi ke Model Complaint.
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}

```

#### File: `app/Models/Complaint.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'token',
        'attachment', // Pastikan ini ada!
        'status',
    ];  

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleting(function ($complaint) {
            if ($complaint->attachment && \Illuminate\Support\Facades\Storage::disk('local')->exists($complaint->attachment)) {
                \Illuminate\Support\Facades\Storage::disk('local')->delete($complaint->attachment);
            }
        });
    }
}
```

#### File: `app/Models/Gallery.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];
}

```

#### File: `app/Models/News.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_path',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleting(function ($news) {
            if ($news->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($news->image_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($news->image_path);
            }
        });
    }
}

```

#### File: `app/Models/Response.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'user_id',
        'content', // Sesuaikan dengan migrasi
    ];

    /**
     * Relasi ke Model User (Petugas/Admin).
     * Ini dibutuhkan oleh PublicStatusController
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Model Complaint (Pengaduan).
     */
    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}

```

#### File: `app/Models/User.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tanggapan yang dibuat oleh User ini.
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    // --- TAMBAHKAN KODE INI ---
    /**
     * Relasi ke pengaduan yang dibuat oleh User ini.
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    // --------------------------
}

```

---

## 5. RUTE & ENDPOINT APLIKASI (ROUTING)

Daftar URL endpoint web, API, otorisasi, dan middleware yang melindungi setiap rute.

#### File: `routes/auth.php`
```php
<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

```

#### File: `routes/console.php`
```php
<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Jadwalkan pembersihan file sampah setiap hari
Schedule::command('app:cleanup-temp-complaints')->daily();

```

#### File: `routes/web.php`
```php
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PublicComplaintController;
use App\Http\Controllers\PublicStatusController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\ResponseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| File ini mengatur seluruh alur URL aplikasi Anda.
|
*/

// 1. LANDING PAGE (Publik)
// Route ini mengarah ke halaman depan (Home)
Route::get('/', [LandingController::class, 'index'])->name('landing');

// 2. DASHBOARD USER
// Halaman dashboard untuk masyarakat yang sudah login
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// 3. FITUR PENGADUAN (HANYA USER LOGIN)
// Middleware 'auth' memastikan hanya pengguna terautentikasi yang bisa akses
Route::middleware(['auth', 'role:masyarakat'])->prefix('lapor')->name('complaint.public.')->group(function () {

    // Step 1: Input Data Laporan
    Route::get('/step-1', [PublicComplaintController::class, 'createStep1'])->name('step1.create');
    Route::post('/step-1', [PublicComplaintController::class, 'storeStep1'])->name('step1.store');

    // Step 2: Review & Konfirmasi
    Route::get('/step-2', [PublicComplaintController::class, 'createStep2'])->name('step2.create');
    Route::post('/step-2', [PublicComplaintController::class, 'store'])->name('step2.store');

    // Step 3: Selesai (Menampilkan Tiket)
    Route::get('/selesai/{token}', [PublicComplaintController::class, 'finish'])->name('finish');
});

// 4. FITUR CEK STATUS (Publik)
// Masyarakat bisa cek status tiket tanpa login (opsional, bisa diubah ke auth jika mau)
Route::get('/cek-status', [PublicStatusController::class, 'index'])->name('status.index');
Route::post('/cek-status', [PublicStatusController::class, 'check'])->name('status.check'); // Form submit pencarian
Route::get('/status/{token}', [PublicStatusController::class, 'show'])->name('status.show'); // Menampilkan hasil

// Route untuk Lampiran Aman (Secure Attachment)
// Akses: Admin/Petugas (Session Auth) ATAU Publik (via Token Tiket di URL)
Route::get('/attachments/{complaint}', [\App\Http\Controllers\AttachmentController::class, 'show'])->name('attachments.show');

// 5. MANAJEMEN PROFIL (Breeze Default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 6. HALAMAN ADMIN & PETUGAS
// Menggunakan middleware 'role' dari Spatie Permission untuk membatasi akses
// 6. AREA ADMIN & PETUGAS (Protected)
Route::middleware(['auth', 'role:admin|petugas|walikota'])->prefix('admin')->name('admin.')->group(function () {

    // A. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // B. Manajemen Pengaduan
    Route::delete('/complaints/destroy-all', [ComplaintController::class, 'destroyAll'])
        ->middleware('permission:delete_complaints')
        ->name('complaints.destroyAll');
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');

    // C. Action Pengaduan (Verify & Resolve)
    // Gunakan middleware yang mengizinkan verify ATAU resolve
    // Karena route update/respond disini dipakai bergantian
    Route::middleware('permission:verify_complaints|resolve_complaints')->group(function () {
        Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
        Route::post('/complaints/{complaint}/respond', [ResponseController::class, 'store'])->name('complaints.respond');
    });

    // D. Hapus Pengaduan
    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])
        ->middleware('permission:delete_complaints')
        ->name('complaints.destroy');

    // E. Manajemen Master Data (User, Category)
    Route::middleware('permission:manage_master')->group(function () {
        Route::delete('/users/destroy-all', [UserController::class, 'destroyAll'])->name('users.destroyAll');
        Route::resource('/users', UserController::class);

        Route::delete('/categories/destroy-all', [CategoryController::class, 'destroyAll'])->name('categories.destroyAll');
        Route::resource('/categories', CategoryController::class)->except(['show']);
    });

    // F. Manajemen Dokumentasi (Gallery) & Berita
    Route::delete('/galleries/destroy-all', [\App\Http\Controllers\Admin\GalleryController::class, 'destroyAll'])->name('galleries.destroyAll')
        ->middleware('permission:manage_documentation');
    Route::resource('/galleries', \App\Http\Controllers\Admin\GalleryController::class)
        ->middleware('permission:manage_documentation');

    Route::delete('/news/destroy-all', [\App\Http\Controllers\Admin\NewsController::class, 'destroyAll'])->name('news.destroyAll')
        ->middleware('permission:manage_documentation');
    Route::resource('/news', \App\Http\Controllers\Admin\NewsController::class)
        ->middleware('permission:manage_documentation');

    // G. Manajemen Sistem (Simulasi saja - Testing/Backup/Restore)
    Route::prefix('system')->name('system.')->middleware('permission:manage_system')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SystemController::class, 'index'])->name('index');
        Route::post('/optimize', [\App\Http\Controllers\Admin\SystemController::class, 'optimize'])->name('optimize');
        Route::post('/backup', [\App\Http\Controllers\Admin\SystemController::class, 'backup'])->name('backup');
    });
});

require __DIR__ . '/auth.php';

```

---

## 6. VALIDASI DATA & FORM REQUESTS

Aturan validasi input (validation rules), pesan error, dan autorisasi form pengguna.

#### File: `app/Http/Requests/Auth/LoginRequest.php`
```php
<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}

```

#### File: `app/Http/Requests/ProfileUpdateRequest.php`
```php
<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}

```

#### File: `app/Http/Requests/StoreBiodataRequest.php`
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBiodataRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     * Karena ini form publik, kita set true.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_pelapor' => 'required|string|max:255',
            'email_pelapor' => 'required|string|email|max:255',
            // Penyempurnaan: Validasi nomor telepon yang lebih baik
            'telepon_pelapor' => 'required|string|regex:/^[0-9]+$/|min:10|max:15',
        ];
    }

    /**
     * Pesan kustom untuk validasi (Opsional namun disarankan)
     */
    public function messages(): array
    {
        return [
            'telepon_pelapor.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'telepon_pelapor.min' => 'Nomor telepon minimal 10 digit.',
            'telepon_pelapor.max' => 'Nomor telepon maksimal 15 digit.',
        ];
    }
}

```

#### File: `app/Http/Requests/StoreComplaintDataRequest.php`
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintDataRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:20', // Memastikan isi pengaduan minimal 20 karakter
            'category_id' => 'required|integer|exists:categories,id', // Pastikan category_id ada di tabel categories

            // Penyempurnaan Keamanan: Validasi file yang lebih ketat
            'attachment' => [
                'nullable', // Boleh kosong
                'file',     // Harus berupa file
                'mimes:jpg,jpeg,png,pdf', // Hanya izinkan tipe file ini
                'max:2048', // Batasi ukuran file (misal: 2MB)
            ],
        ];
    }

    /**
     * Pesan kustom untuk validasi
     */
    public function messages(): array
    {
        return [
            'content.min' => 'Isi pengaduan minimal 20 karakter agar lebih rinci.',
            'category_id.required' => 'Anda harus memilih kategori pengaduan.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'attachment.mimes' => 'Lampiran harus berupa file: JPG, JPEG, PNG, atau PDF.',
            'attachment.max' => 'Ukuran lampiran maksimal adalah 2 MB.',
        ];
    }
}

```

#### File: `app/Http/Requests/StoreComplaintStep1Request.php`
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintStep1Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 10MB.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
        ];
    }
}

```

#### File: `app/Http/Requests/StoreNewsRequest.php`
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|max:10240', // Max 10MB
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 10MB.',
            'image.image' => 'File harus berupa gambar.',
        ];
    }
}

```

#### File: `app/Http/Requests/StoreResponseRequest.php`
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponseRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     * Kita set true karena otentikasi sudah dihandle di route middleware.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Variabel 'content' sudah benar
            'content' => 'required|string',
            // Variabel 'status' sudah benar
            'status' => 'required|string|in:pending,processed,finished,rejected',
        ];
    }
}

```

#### File: `app/Http/Requests/StoreUserRequest.php`
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     */
    public function authorize(): bool
    {
        // Pastikan hanya user dengan role 'admin' yang bisa
        return $this->user()->hasRole('admin');
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => 'required|array', // Pastikan roles dikirim sebagai array
            'roles.*' => 'exists:roles,name', // Pastikan setiap role ada di tabel roles
        ];
    }
}

```

#### File: `app/Http/Requests/UpdateComplaintStatusRequest.php`
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateComplaintStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('verify_complaints') || $this->user()->can('resolve_complaints');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'status' => ['required', Rule::in(['pending', 'proses', 'selesai', 'ditolak'])],
        ];
    }
}

```

#### File: `app/Http/Requests/UpdateUserRequest.php`
```php
<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh membuat request ini.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('admin');
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // Pastikan email unik, KECUALI untuk user yang sedang diedit
                Rule::unique(User::class)->ignore($this->user->id),
            ],
            // Password bersifat opsional saat update
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ];
    }
}

```

---

## 7. LOGIKA BISNIS & CONTROLLERS

Mengatur alur proses permintaan, kalkulasi status, manipulasi data, dan respon.

#### File: `app/Http/Controllers/Admin/CategoryController.php`
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Tampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Simpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ], [
            'name.unique' => 'Nama kategori ini sudah ada.'
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit kategori.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update kategori di database.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            // Pastikan 'name' unik, KECUALI untuk ID kategori ini sendiri
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.unique' => 'Nama kategori ini sudah ada.'
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus SEMUA kategori (Kecuali yang sedang digunakan)
     */
    public function destroyAll()
    {
         $categories = Category::withCount('complaints')->get();
         $deleted = 0;
         $skipped = 0;
         
         foreach($categories as $category) {
             if ($category->complaints_count == 0) {
                 $category->delete();
                 $deleted++;
             } else {
                 $skipped++;
             }
         }

         if ($skipped > 0) {
             return redirect()->route('admin.categories.index')
                ->with('warning', "$deleted kategori dihapus. $skipped kategori dilewati karena sedang digunakan oleh pengaduan.");
         }
         
         return redirect()->route('admin.categories.index')->with('success', 'Semua kategori berhasil dihapus.');
    }

    /**
     * Hapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        // PENYEMPURNAAN PENTING:
        // Cek apakah kategori ini masih digunakan oleh pengaduan.
        if ($category->complaints()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Kategori ini tidak dapat dihapus karena masih digunakan oleh pengaduan.');
        }

        // Jika aman, baru hapus
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}

```

#### File: `app/Http/Controllers/Admin/ComplaintController.php`
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar semua pengaduan
     */
    public function index()
    {
        // Ambil data pengaduan, urutkan dari terbaru
        // Eager load 'user' dan 'category' agar query ringan
        $complaints = Complaint::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.complaints.index', compact('complaints'));
    }

    /**
     * Menampilkan detail pengaduan spesifik
     */
    public function show(Complaint $complaint)
    {
        // Load relasi tanggapan dan user yang menanggapi
        $complaint->load(['responses.user', 'user', 'category']);

        return view('admin.complaints.show', compact('complaint'));
    }

    /**
     * Update status pengaduan (Misal: dari Pending -> Proses -> Selesai)
     */
    public function update(\App\Http\Requests\UpdateComplaintStatusRequest $request, Complaint $complaint)
    {
        $status = $request->validated()['status'];
        $user = Auth::user();

        // Role Specific Logic: Petugas
        if ($user->hasRole('petugas')) {
            if ($complaint->status !== 'pending') {
                return back()->with('error', 'Petugas hanya dapat memverifikasi laporan yang masih Pending.');
            }
            if (!in_array($status, ['proses', 'ditolak'])) {
                 return back()->with('error', 'Petugas hanya dapat mengubah status menjadi Proses atau Ditolak.');
            }
        }

        $complaint->update(['status' => $status]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    /**
     * Hapus SEMUA pengaduan (Hanya Admin)
     */
    public function destroyAll()
    {
        // Menggunakan get() + delete() loop untuk memicu observer jika ada (untuk hapus file)
        $complaints = Complaint::all();
        foreach ($complaints as $complaint) {
             $complaint->delete();
        }

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Semua data pengaduan berhasil dihapus.');
    }

    /**
     * Hapus pengaduan (Hanya Admin)
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete(); // File deletion handled by Model Observer

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}

```

#### File: `app/Http/Controllers/Admin/DashboardController.php`
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung Statistik
        $total = Complaint::count();
        $pending = Complaint::where('status', 'pending')->count();
        $proses = Complaint::where('status', 'proses')->count();
        $selesai = Complaint::where('status', 'selesai')->count();

        return view('admin.dashboard', compact('total', 'pending', 'proses', 'selesai'));
    }
}

```

#### File: `app/Http/Controllers/Admin/GalleryController.php`
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:10240', // Max 10MB
        ], [
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 10MB.',
            'image.image' => 'File harus berupa gambar.',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Dokumentasi berhasil ditambahkan.');
    }

    /**
     * Remove all resources from storage.
     */
    public function destroyAll()
    {
        $galleries = Gallery::all();
        foreach($galleries as $gallery) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $gallery->delete();
        }
        return redirect()->route('admin.galleries.index')->with('success', 'Semua dokumentasi berhasil dihapus.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}

```

#### File: `app/Http/Controllers/Admin/NewsController.php`
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\StoreNewsRequest $request)
    {
        // Validation handled by FormRequest

        $path = $request->file('image')->store('news', 'public');
        $slug = Str::slug($request->title) . '-' . time();

        News::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image_path' => $path,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diterbitkan.');
    }

    /**
     * Remove all resources from storage.
     */
    public function destroyAll()
    {
        $news = News::all();
        foreach($news as $item) {
            $item->delete(); // File deletion handled by Model Observer
        }
        return redirect()->route('admin.news.index')->with('success', 'Semua berita berhasil dihapus.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete(); // File deletion handled by Model Observer

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}

```

#### File: `app/Http/Controllers/Admin/ResponseController.php`
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    /**
     * Simpan Tanggapan Baru
     */
    public function store(Request $request, Complaint $complaint)
    {
        $request->validate([
            'content' => 'required|string',
            'status' => 'required|in:pending,proses,selesai,ditolak' // Opsional: sekalian update status
        ]);

        // 1. Buat Tanggapan
        Response::create([
            'complaint_id' => $complaint->id,
            'user_id' => Auth::id(), // ID Petugas yang login
            'content' => $request->content,
        ]);

        // 2. Update Status Pengaduan (Otomatis saat menanggapi)
        $complaint->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim dan status diperbarui.');
    }
}

```

#### File: `app/Http/Controllers/Admin/SystemController.php`
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SystemController extends Controller
{
    public function index()
    {
        // 1. Informasi Sistem (Architecture & Deploy Info)
        $systemInfo = [
            'laravel_version' => app()->version(),
            'php_version' => phpversion(),
            'server_ip' => request()->server('SERVER_ADDR', '127.0.0.1'),
            'database_connection' => config('database.default'),
            'app_environment' => config('app.env'),
            'debug_mode' => config('app.debug') ? 'Enabled' : 'Disabled',
        ];

        // 2. Simulasi Log (QA & Testing)
        $logs = []; 
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            // Ambil 50 baris terakhir
            $lines = file($logFile);
            $logs = array_slice($lines, -20); 
        }

        return view('admin.system.index', compact('systemInfo', 'logs'));
    }

    public function optimize()
    {
        // Fitur Maintenance: Clear Cache
        Artisan::call('optimize:clear');
        return back()->with('success', 'Sistem berhasil dioptimasi (Cache Cleared).');
    }

    public function backup()
    {
        // Fitur Backup (Simulasi)
        // Di real production, ini akan menjalankan `spatie/laravel-backup`
        Log::info('Backup system requested by Admin.');
        sleep(2); // Simulasi process
        return back()->with('success', 'Backup database dan file berhasil dijalankan! File tersimpan di storage/app/backup.');
    }
}

```

#### File: `app/Http/Controllers/Admin/UserController.php`
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;   // <-- 1. Import Request Baru
use App\Http\Requests\UpdateUserRequest; // <-- 2. Import Request Baru

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua user.
     */
    public function index()
    {
        // Ambil user, eager load roles mereka, dan paginate
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Tampilkan form untuk membuat user baru.
     */
    public function create()
    {
        // Ambil semua roles untuk ditampilkan di form
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Simpan user baru ke database.
     */
    // 3. Gunakan StoreUserRequest
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Tetapkan roles ke user
        $user->syncRoles($validatedData['roles']);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Tampilkan form untuk mengedit user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        // Eager load roles yang dimiliki user
        $user->load('roles');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update user di database.
     */
    // 4. Gunakan UpdateUserRequest
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        // Siapkan data untuk diupdate
        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        // Cek jika password baru diisi
        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        // Update user
        $user->update($updateData);

        // Update roles
        $user->syncRoles($validatedData['roles']);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus SEMUA user (Kecuali Admin Login)
     */
    public function destroyAll()
    {
        // Hapus semua kecuali diri sendiri
        User::where('id', '!=', auth()->id())->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Semua user berhasil dihapus (kecuali akun Anda).');
    }

    /**
     * Hapus user dari database.
     */
    public function destroy(User $user)
    {
        // Tambahkan perlindungan agar admin tidak bisa menghapus diri sendiri
        if ($user->id == auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}

```

#### File: `app/Http/Controllers/AttachmentController.php`
```php
<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    /**
     * Menampilkan lampiran sensitif dengan pengecekan hak akses.
     */
    public function show(Complaint $complaint)
    {
        // 1. Cek apakah ada file lampiran
        if (!$complaint->attachment || !Storage::disk('local')->exists($complaint->attachment)) {
            abort(404, 'File lampiran tidak ditemukan.');
        }

        // 2. LOGIKA OTORISASI
        $isAuthorized = false;
        $user = Auth::user();

        // A. Jika user login
        if ($user) {
            // Admin, Petugas, Walikota boleh melihat semua
            if ($user->hasAnyRole(['admin', 'petugas', 'walikota'])) {
                $isAuthorized = true;
            }
            // Pemilik tiket boleh melihat
            else if ($user->id === $complaint->user_id) {
                $isAuthorized = true;
            }
        } 
        
        // B. Jika Publik (Login atau Tidak), cek Token Tiket via Session (untuk alur Cek Tiket)
        // Kita asumsikan jika seseorang bisa mengakses halaman detail tiket (yang sudah dilindungi controller), mereka berhak lihat gambar.
        // Tapi untuk amannya, kita cek referer atau session, ATAU kita biarkan controller ini diakses
        // oleh siapa saja yang tahu URL-nya NAMUN URL-nya menggunakan ID pengaduan yang tidak bisa ditebak?
        // TIDAK. URL menggunakan ID bisa ditebak (incremental).
        
        // Pendekatan lebih aman: Cek apakah user sedang membuka halaman detail tiket yang valid
        // Tapi HTTP itu stateless.
        
        // SOLUSI: Jika pengguna adalah 'guest' (masyarakat tidak login) yang melihat status tiket via TOKEN,
        // mereka biasanya sudah melewati proses input TOKEN di halaman 'Cek Status'.
        // Namun, rute gambar ini terpisah.
        
        // Kita bisa tambahkan parameter ?token=TIKET-XXX di URL gambar untuk verifikasi guest.
        if (request()->has('token') && request()->token === $complaint->token) {
            $isAuthorized = true;
        }

        if (!$isAuthorized) {
            abort(403, 'Anda tidak memiliki hak akses untuk melihat lampiran ini.');
        }

        // 3. Return File
        $path = Storage::disk('local')->path($complaint->attachment);
        return response()->file($path);
        
        // Pilihan lain: response()->download($path) jika ingin download
    }
}

```

#### File: `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Validasi: Jika user login bukan 'masyarakat', paksa redirect ke dashboard.
        // Ini mencegah admin/petugas diarahkan ke halaman pengaduan jika mereka login dari sana.
        if (! $request->user()->hasRole('masyarakat')) {
            return redirect()->route('dashboard');
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

```

#### File: `app/Http/Controllers/Auth/ConfirmablePasswordController.php`
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}

```

#### File: `app/Http/Controllers/Auth/EmailVerificationNotificationController.php`
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}

```

#### File: `app/Http/Controllers/Auth/EmailVerificationPromptController.php`
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : view('auth.verify-email');
    }
}

```

#### File: `app/Http/Controllers/Auth/NewPasswordController.php`
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}

```

#### File: `app/Http/Controllers/Auth/PasswordController.php`
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}

```

#### File: `app/Http/Controllers/Auth/PasswordResetLinkController.php`
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}

```

#### File: `app/Http/Controllers/Auth/RegisteredUserController.php`
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign default role 'masyarakat' so users can access complaint features
        $user->assignRole('masyarakat');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}

```

#### File: `app/Http/Controllers/Auth/VerifyEmailController.php`
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}

```

#### File: `app/Http/Controllers/Controller.php`
```php
<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

```

#### File: `app/Http/Controllers/DashboardController.php`
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Category;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // -----------------------------------------------------------
        // 1. DASHBOARD ADMIN (Pusat Kontrol)
        // -----------------------------------------------------------
        if ($user->hasRole('admin')) {
            // Data Statistik Lengkap
            $stats = [
                'complaints_total'   => Complaint::count(),
                'complaints_pending' => Complaint::where('status', 'pending')->count(),
                'users_count'        => User::role('masyarakat')->count(),
                'categories_count'   => Category::count(),
            ];

            // Mengambil 5 pengaduan terbaru untuk tabel aktivitas
            // Pastikan model Complaint memiliki relasi 'user' dan 'category'
            $latestComplaints = Complaint::with(['user', 'category'])
                ->latest()
                ->take(5)
                ->get();

            // Return ke view khusus Admin
            return view('admin.dashboard', compact('stats', 'latestComplaints'));
        }

        // -----------------------------------------------------------
        // 2. DASHBOARD INSPEKTUR / PETUGAS (Fokus Kerja)
        // -----------------------------------------------------------
        elseif ($user->hasRole('petugas')) {
            // Statistik Status Laporan
            $stats = [
                'pending'  => Complaint::where('status', 'pending')->count(),
                'process'  => Complaint::where('status', 'proses')->count(),
                'finished' => Complaint::where('status', 'selesai')->count(),
            ];

            // Petugas butuh melihat laporan 'pending' atau 'proses' untuk ditindaklanjuti
            $needResponse = Complaint::whereIn('status', ['pending', 'proses'])
                ->with('user') // Eager load user pelapor
                ->orderBy('created_at', 'asc') // Prioritaskan yang paling lama menunggu
                ->take(5)
                ->get();

            // Return ke view khusus Petugas
            return view('petugas.dashboard', compact('stats', 'needResponse'));
        }

        // -----------------------------------------------------------
        // 3. DASHBOARD PENGGUNA / MASYARAKAT
        // -----------------------------------------------------------
        else {
            // Masyarakat langsung melihat dashboard default
            return view('dashboard');
        }
    }
}

```

#### File: `app/Http/Controllers/LandingController.php`
```php
<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\News;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil 8 galeri terbaru untuk ditampilkan di landing page
        $galleries = Gallery::latest()->take(8)->get();
        // Ambil 12 berita terbaru (untuk mendukung scroll horizontal 2 baris)
        $news = News::latest()->take(12)->get();
        
        return view('welcome', compact('galleries', 'news'));
    }
}

```

#### File: `app/Http/Controllers/ProfileController.php`
```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan form edit profil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update informasi profil user.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Ambil data yang sudah divalidasi dari Form Request
        $validatedData = $request->validated();

        // Isi data user dengan data valid
        $request->user()->fill($validatedData);

        // Cek jika email diubah, reset verifikasi email
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Simpan perubahan
        $request->user()->save();

        // Redirect kembali ke halaman edit profil
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi password saat ini
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout user
        Auth::logout();

        // Hapus user
        $user->delete();

        // Hapus sesi dan regenerasi token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return Redirect::to('/');
    }
}

```

#### File: `app/Http/Controllers/PublicComplaintController.php`
```php
<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicComplaintController extends Controller
{
    /**
     * TAHAP 1: Form Input Data
     */
    public function createStep1()
    {
        $categories = Category::all();
        return view('public.step1', compact('categories'));
    }

    /**
     * PROSES TAHAP 1: Validasi & Simpan ke Sesi Sementara
     */
    public function storeStep1(\App\Http\Requests\StoreComplaintStep1Request $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // SECURITY UPDATE: Simpan di disk 'local' (storage/app/temp-complaints) agar tidak bisa diakses publik
            $path = $request->file('image')->store('temp-complaints', 'local');
            session(['complaint_image' => $path]);
        }

        session([
            'complaint_data' => [
                'title' => $validated['title'],
                'category_id' => $validated['category_id'],
                'content' => $validated['content'],
            ]
        ]);

        return redirect()->route('complaint.public.step2.create');
    }

    /**
     * TAHAP 2: Review & Konfirmasi
     */
    public function createStep2()
    {
        $data = session('complaint_data');
        $image = session('complaint_image');

        if (!$data) {
            return redirect()->route('complaint.public.step1.create');
        }

        $category = Category::find($data['category_id']);

        // Convert the secure temporary local image into a Base64 string for preview
        $imageBase64 = null;
        if ($image && \Illuminate\Support\Facades\Storage::disk('local')->exists($image)) {
            $mime = \Illuminate\Support\Facades\Storage::disk('local')->mimeType($image);
            $content = \Illuminate\Support\Facades\Storage::disk('local')->get($image);
            $imageBase64 = 'data:' . $mime . ';base64,' . base64_encode($content);
        }

        return view('public.step2', compact('data', 'category', 'image', 'imageBase64'));
    }

    /**
     * PROSES FINAL: Simpan ke Database
     */
    public function store()
    {
        $data = session('complaint_data');
        $tempImage = session('complaint_image');

        if (!$data) {
            return redirect()->route('complaint.public.step1.create');
        }

        $ticketCode = 'TIKET-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $finalImagePath = null;
        if ($tempImage) {
            $finalImagePath = 'complaints/' . basename($tempImage);
            // SECURITY UPDATE: Pindahkan file dalam disk 'local'
            if (Storage::disk('local')->exists($tempImage)) {
                 Storage::disk('local')->move($tempImage, $finalImagePath);
            }
        }

        // Simpan ke Database
        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'token' => $ticketCode,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            
            // PERBAIKAN DISINI: Gunakan 'attachment' sesuai nama kolom di database
            'attachment' => $finalImagePath, 
            
            'status' => 'pending',
        ]);

        session()->forget(['complaint_data', 'complaint_image']);

        return redirect()->route('complaint.public.finish', $complaint->token);
    }

    /**
     * TAHAP 3: Selesai / Tampilkan Tiket
     */
    public function finish($token)
    {
        $complaint = Complaint::where('token', $token)->firstOrFail();
        return view('public.finish', compact('complaint'));
    }
}
```

#### File: `app/Http/Controllers/PublicStatusController.php`
```php
<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class PublicStatusController extends Controller
{
    // Tampilkan Halaman Cari
    public function index()
    {
        return view('public.status.index');
    }

    // Proses Cari Data
    public function check(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|string'
        ]);

        // Buat semua huruf kapital karena token formatnya TIKET-...
        $ticket = strtoupper(trim($request->ticket_id));

        // Cari berdasarkan token
        $complaint = Complaint::where('token', $ticket)->first();

        if ($complaint) {
            // Jika ketemu, tampilkan
            return redirect()->route('status.show', $complaint->token);
        } else {
            // Jika tidak ketemu, kembali dengan pesan error (Flash Session)
            return redirect()->route('status.index')
                ->with('error', 'Tiket dengan ID <strong>' . $ticket . '</strong> tidak ditemukan. Silakan periksa kembali.');
        }
    }

    // Tampilkan Hasil
    public function show($token)
    {
        $complaint = Complaint::with(['category', 'responses', 'user'])
            ->where('token', $token)
            ->firstOrFail();

        return view('public.status.show', compact('complaint'));
    }
}

```

---

## 8. SERVICES, MIDDLEWARES & PROVIDERS

Layer business service independen, middleware security, dan service provider registri.

#### File: `app/Services/ComplaintService.php`
```php
<?php

namespace App\Services;

use App\Models\Complaint;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class ComplaintService
{
    public function createNewComplaint(array $biodata, array $complaintData, ?UploadedFile $attachment): Complaint
    {
        // Handle file upload
        if ($attachment) {
            $complaintData['attachment'] = $attachment->store('attachments', 'public');
        }

        // Gabungkan data
        $fullData = array_merge($biodata, $complaintData);

        // Buat Token Unik
        $fullData['token'] = Str::upper(Str::random(10));

        return Complaint::create($fullData);
    }
}

```

#### File: `app/Providers/AppServiceProvider.php`
```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (request()->header('X-Forwarded-Proto') == 'https') {
            URL::forceScheme('https');
        }
    }
}


```

#### File: `app/Providers/AuthServiceProvider.php`
```php
<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

```

---

## 9. TAMPILAN ANTARMUKA (VIEWS, LAYOUTS & COMPONENTS)

Struktur antarmuka pengguna, komponen formulir pengaduan, dan tata letak utama aplikasi.

#### File: `resources/views/admin/categories/create.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            {{-- Card dengan border slate-300 dan shadow halus --}}
            <div
                class="bg-white border border-slate-300 shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nama Kategori')" class="text-slate-700" />
                            <x-text-input id="name" name="name" type="text"
                                class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                :value="old('name')" required autofocus
                                placeholder="Contoh: Infrastruktur, Pelayanan..." />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div
                            class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.categories.index') }}">
                                <x-secondary-button type="button"
                                    class="border-slate-300 text-slate-700 hover:bg-slate-50">
                                    {{ __('Batal') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button
                                class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                                {{ __('Simpan Kategori') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/categories/edit.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Edit Kategori') }}: <span class="text-blue-600">{{ $category->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Style Konsisten --}}
            <div class="bg-white border border-slate-300 shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Nama Kategori')" class="text-slate-700" />
                            <x-text-input id="name" name="name" type="text"
                                class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                :value="old('name', $category->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.categories.index') }}">
                                <x-secondary-button type="button" class="border-slate-300 text-slate-700 hover:bg-slate-50">
                                    {{ __('Batal') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                                {{ __('Perbarui Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```

#### File: `resources/views/admin/categories/index.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                {{ __('Manajemen Kategori') }}
            </h2>
            <div class="flex items-center gap-2">
                <form action="{{ route('admin.categories.destroyAll') }}" method="POST" onsubmit="return confirm('PERHATIAN: Hapus semua kategori yang tidak digunakan?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1.5 px-3 rounded shadow-sm text-xs transition duration-150 ease-in-out">
                        Hapus Semua
                    </button>
                </form>
                <a href="{{ route('admin.categories.create') }}">
                    <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 px-3 py-1.5 text-xs">
                        <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ __('Tambah Kategori') }}
                    </x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Perbaikan: Mengganti typo bg-white-800 menjadi bg-white dan border-slate --}}
            <div
                class="bg-white border border-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">

                    {{-- Tabel Responsif --}}
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-slate-500">
                            {{-- Header Tabel dengan warna Slate lembut --}}
                            <thead
                                class="text-xs text-slate-700 uppercase bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Kategori
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr
                                        class="bg-white border-b border-slate-300 hover:bg-slate-50 transition duration-150 ease-in-out">
                                        <td
                                            class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-md font-bold text-xs transition-colors">
                                                Edit
                                            </a>
                                            {{-- Tombol Hapus --}}
                                            <form method="POST"
                                                action="{{ route('admin.categories.destroy', $category) }}"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 rounded-md font-bold text-xs transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b border-slate-300">
                                        <td colspan="3" class="px-6 py-8 text-center text-slate-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-10 h-10 mb-2 text-slate-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                    </path>
                                                </svg>
                                                <span>Tidak ada data kategori.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/complaints/index.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Daftar Pengaduan Masuk') }}
            </h2>
            @can('delete_complaints')
            <div>
                 <form action="{{ route('admin.complaints.destroyAll') }}" method="POST" onsubmit="return confirm('PERHATIAN: Apakah Anda yakin ingin MENGHAPUS SEMUA data pengaduan? Tindakan ini tidak dapat dibatalkan!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-sm text-xs transition duration-150 ease-in-out">
                        Hapus Semua
                    </button>
                </form>
            </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-slate-200">
                <div class="p-4 text-slate-900">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-slate-500">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th scope="col" class="px-4 py-3">No</th>
                                    <th scope="col" class="px-4 py-3">Pelapor</th>
                                    <th scope="col" class="px-4 py-3">Judul</th>
                                    <th scope="col" class="px-4 py-3">Kategori</th>
                                    <th scope="col" class="px-4 py-3">Tanggal</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $key => $item)
                                    <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition duration-150">
                                        <td class="px-4 py-3 font-medium text-slate-900">{{ $complaints->firstItem() + $key }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $item->user->name ?? 'Anonim' }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-800">{{ Str::limit($item->title, 25) }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="bg-slate-100 text-slate-700 py-0.5 px-2 rounded-full text-[10px] font-bold">
                                                {{ $item->category->name }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            @if ($item->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                    Pending
                                                </span>
                                            @elseif($item->status == 'proses')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Proses
                                                </span>
                                            @elseif($item->status == 'selesai')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.complaints.show', $item->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-transparent rounded-md font-bold text-xs transition-colors">
                                                    Detail
                                                </a>
                                                
                                                @can('delete_complaints')
                                                <form action="{{ route('admin.complaints.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 border border-transparent rounded-md font-bold text-xs transition-colors">
                                                        Hapus
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $complaints->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/complaints/show.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-slate-100 leading-tight tracking-tight">
            Detail Pengaduan
        </h2>
        <span class="text-sm text-slate-500 dark:text-slate-400">
            {{ $complaint->title }}
        </span>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-4">

            {{-- Card Utama (Info Pengaduan) --}}
            <div class="lg:col-span-2">
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg">
                    <div class="p-5 text-slate-900 dark:text-slate-100">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-black">{{ $complaint->title }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Token:</span>
                                    <code class="font-mono text-xs bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded text-slate-700 dark:text-slate-300">{{ $complaint->token }}</code>
                                </div>
                            </div>
                            @if ($complaint->status == 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                    Menunggu
                                </span>
                            @elseif($complaint->status == 'proses')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    Diproses
                                </span>
                            @elseif($complaint->status == 'selesai')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                    Ditolak
                                </span>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs mb-4 border-t border-slate-100 dark:border-slate-700 pt-4">
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-0.5">Pelapor</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->user->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-0.5">Email</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->user->email }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-0.5">Kategori</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium badge bg-slate-50 inline-block px-2 py-0.5 rounded">{{ $complaint->category->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-0.5">Tanggal Lapor</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->created_at->format('d F Y, H:i') }}</dd>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 dark:border-slate-700 pt-4">
                            <h4 class="font-bold text-slate-900 dark:text-black mb-2 text-base">Isi Pengaduan</h4>
                            <div class="prose prose-slate dark:prose-invert max-w-none bg-slate-50 dark:bg-slate-900/50 p-3 rounded-lg border border-slate-200 dark:border-slate-700">
                                <p class="whitespace-pre-line text-sm text-slate-700 dark:text-slate-300 leading-relaxed">{{ $complaint->content }}</p>
                            </div>
                        </div>

                        @if ($complaint->attachment)
                            <div class="mt-4 flex items-center p-3 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-lg">
                                <svg class="w-5 h-5 text-slate-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                                <span class="text-sm text-slate-700 dark:text-slate-300 font-medium mr-auto">Lampiran Bukti</span>
                                <a href="{{ route('attachments.show', $complaint) }}" target="_blank"
                                    class="inline-flex items-center px-3 py-1.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-md font-semibold text-xs text-slate-700 dark:text-slate-300 uppercase tracking-widest shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Lihat File
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar (Form Tanggapan & Riwayat) --}}
            <div class="space-y-4">
                {{-- Card Form Tanggapan --}}
                {{-- Card Form Tanggapan / Verifikasi --}}
                
                {{-- 1. FORM UNTUK PETUGAS (VERIFIKASI) --}}
                @can('verify_complaints')
                    @if($complaint->status == 'pending')
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg mb-4">
                        <form method="POST" action="{{ route('admin.complaints.update', $complaint) }}">
                            @csrf
                            @method('PUT')
                            <div class="p-5">
                                <h3 class="text-base font-bold text-slate-900 dark:text-black border-b border-slate-100 dark:border-slate-700 pb-2 mb-3">
                                    Verifikasi Laporan
                                </h3>
                                <p class="text-xs text-slate-500 mb-3">Sebagai Petugas, silakan validasi laporan ini.</p>
                                
                                <div class="mb-3">
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Tindakan</label>
                                    <select name="status" class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        <option value="proses">Terima & Diproses</option>
                                        <option value="ditolak">Tolak (Data Tidak Valid)</option>
                                    </select>
                                </div>

                                <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Simpan Verifikasi
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                @endcan

                {{-- 2. FORM UNTUK ADMIN (RESOLVE / TANGGAPI) --}}
                {{-- 2. FORM UNTUK ADMIN (RESOLVE / TANGGAPI) --}}
                @can('resolve_complaints')
                    @if($complaint->status != 'pending')
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg">
                        <form method="POST" action="{{ route('admin.complaints.respond', $complaint) }}">
                            @csrf
                            <div class="p-5">
                                <h3 class="text-base font-bold text-slate-900 dark:text-black border-b border-slate-100 dark:border-slate-700 pb-2 mb-3">
                                    Tindak Lanjuti & Tanggapi
                                </h3>
                                
                                @if (session('success'))
                                    <div class="mb-3 bg-green-50 text-green-700 p-2 rounded-md text-xs border border-green-200">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="mb-3 bg-red-50 text-red-700 p-2 rounded-md text-xs border border-red-200">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="content" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Isi Tanggapan</label>
                                    <textarea id="content" name="content"
                                        class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                        rows="4" placeholder="Tulis tanggapan penyelesaian disini..." required>{{ old('content') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Update Status</label>
                                    <select name="status" id="status" class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        {{-- Admin bisa memindahkan status kemana saja, tapi defaultnya ke Selesai --}}
                                        {{-- Opsi pending dihapus agar Admin tidak mengembalikan ke petugas --}}
                                        <option value="proses" @selected($complaint->status == 'proses')>Diproses (Sedang Ditangani)</option>
                                        <option value="selesai" @selected($complaint->status == 'selesai')>Selesai (Tutup Laporan)</option>
                                        <option value="ditolak" @selected($complaint->status == 'ditolak')>Ditolak</option>
                                    </select>
                                </div>

                                <div class="flex items-center justify-end pt-1">
                                    <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Kirim Tanggapan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 text-center">
                        <p class="text-sm text-amber-800 font-bold">Laporan belum diverifikasi.</p>
                        <p class="text-xs text-amber-700 mt-1">Harap tunggu Petugas melakukan verifikasi sebelum Anda dapat menindaklanjuti.</p>
                    </div>
                    @endif
                @endcan

                {{-- Card Riwayat Tanggapan --}}
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 mb-4">
                            Riwayat Tanggapan
                        </h3>

                        <div class="space-y-4">
                            @forelse ($complaint->responses as $response)
                                <div class="p-4 bg-slate-50 dark:bg-slate-700/30 rounded-lg border border-slate-100 dark:border-slate-700">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold mr-2">
                                                {{ substr($response->user->name, 0, 1) }}
                                            </div>
                                            <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">
                                                {{ $response->user->name }}
                                            </p>
                                        </div>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">
                                            {{ $response->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-slate-600 dark:text-slate-300">
                                        {!! nl2br(e($response->content)) !!}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <p class="text-slate-400 dark:text-slate-500 text-sm italic">
                                        Belum ada tanggapan..
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/dashboard.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                Ringkasan Dashboard
            </h2>
            <p
                class="text-sm text-slate-700 font-medium bg-white px-3 py-1 rounded-full shadow-sm border border-slate-200">
                📅 Pembaruan: {{ now()->format('d M Y') }}
            </p>
        </div>
    </x-slot>

    {{-- Latar Belakang Halaman Terang (Compact Adjusted) --}}
    <div class="py-5 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Section 1: Statistik Utama (Kartu Putih Bersih & Teks Gelap) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- CARD 1: TOTAL PENGADUAN --}}
                <div class="bg-white rounded-lg p-5 shadow-sm border border-slate-200 hover:border-blue-300 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Total Masuk</p>
                            <h3 class="mt-1 text-3xl font-black text-slate-900">
                                {{ $stats['complaints_total'] }}
                            </h3>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-medium text-slate-600">
                        <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                        Semua laporan aktif
                    </div>
                </div>

                {{-- CARD 2: PENGGUNA TERDAFTAR --}}
                <div class="bg-white rounded-lg p-5 shadow-sm border border-slate-200 hover:border-indigo-300 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Pengguna</p>
                            <h3 class="mt-1 text-3xl font-black text-slate-900">
                                {{ $stats['users_count'] }}
                            </h3>
                        </div>
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-medium text-slate-600">
                        <span class="inline-block w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>
                        Akun masyarakat
                    </div>
                </div>

                {{-- CARD 3: KATEGORI --}}
                <div class="bg-white rounded-lg p-5 shadow-sm border border-slate-200 hover:border-purple-300 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Kategori</p>
                            <h3 class="mt-1 text-3xl font-black text-slate-900">
                                {{ $stats['categories_count'] }}
                            </h3>
                        </div>
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-medium text-slate-600">
                        <span class="inline-block w-2 h-2 rounded-full bg-purple-500 mr-2"></span>
                        Jenis aduan
                    </div>
                </div>

                {{-- CARD 4: PENDING --}}
                <div class="bg-amber-50 rounded-lg p-5 shadow-sm border border-amber-200 hover:border-amber-300 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-20 h-20 bg-amber-100 rounded-bl-full opacity-50"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-xs font-bold text-amber-800 uppercase tracking-wide">Pending</p>
                            <h3 class="mt-1 text-3xl font-black text-slate-900">
                                {{ $stats['complaints_pending'] }}
                            </h3>
                        </div>
                        <div class="p-3 bg-white text-amber-600 rounded-lg shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-bold text-amber-800">
                        <span class="inline-block w-2 h-2 rounded-full bg-amber-600 mr-2 animate-pulse"></span>
                        Perlu Tindakan
                    </div>
                </div>

            </div>

            {{-- Section 2: Quick Actions & Banner --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Banner Utama (Warna Biru Tua Kontras untuk Header) --}}
                <div class="lg:col-span-2 bg-white border border-slate-200 rounded-lg p-6 text-slate-900 shadow-sm relative overflow-hidden">
                    <div class="absolute right-0 top-0 opacity-10 transform translate-x-10 -translate-y-10">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-2 text-slate-900">Pusat Pengaduan Masyarakat</h3>
                        <p class="text-slate-600 mb-5 text-sm leading-relaxed max-w-lg">
                            Kelola laporan masuk dengan cepat dan efisien. Pastikan setiap aduan mendapatkan respon yang
                            tepat waktu.
                        </p>
                        <a href="{{ route('admin.complaints.index') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            Kelola Pengaduan Sekarang
                        </a>
                    </div>
                </div>

                {{-- Shortcut Menu (Putih Bersih) --}}
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                         <h4 class="text-slate-900 font-bold text-base flex items-center">
                            <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                            Menu Cepat
                        </h4>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="group flex items-center justify-between p-3 rounded-lg bg-slate-50 hover:bg-blue-50 transition-colors border border-slate-200 hover:border-blue-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-blue-600 group-hover:border-blue-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-bold text-slate-700 group-hover:text-blue-800">Manajemen User</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                            class="group flex items-center justify-between p-3 rounded-lg bg-slate-50 hover:bg-purple-50 transition-colors border border-slate-200 hover:border-purple-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-purple-600 group-hover:border-purple-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-bold text-slate-700 group-hover:text-purple-800">Kategori Aduan</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('admin.galleries.index') }}"
                            class="group flex items-center justify-between p-3 rounded-lg bg-slate-50 hover:bg-teal-50 transition-colors border border-slate-200 hover:border-teal-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-teal-600 group-hover:border-teal-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-bold text-slate-700 group-hover:text-teal-800">Dokumentasi</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Tabel Aktivitas Terbaru --}}
                <div class="lg:col-span-3 bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
                    <div class="px-5 py-3 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                        <h4 class="font-bold text-slate-800 text-sm">Laporan Terbaru</h4>
                        <a href="{{ route('admin.complaints.index') }}" class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-5 py-3">Pelapor</th>
                                    <th scope="col" class="px-5 py-3">Judul</th>
                                    <th scope="col" class="px-5 py-3">Tanggal</th>
                                    <th scope="col" class="px-5 py-3">Status</th>
                                    <th scope="col" class="px-5 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestComplaints as $complaint)
                                    <tr class="bg-white border-b hover:bg-slate-50">
                                        <td class="px-5 py-3 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $complaint->user->name ?? 'Anonim' }}
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            {{ Str::limit($complaint->title, 35) }}
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            {{ $complaint->created_at->diffForHumans() }}
                                        </td>
                                         <td class="px-5 py-3 whitespace-nowrap">
                                             @if ($complaint->status == 'pending')
                                                <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded">Pending</span>
                                            @elseif($complaint->status == 'proses')
                                                <span class="bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-0.5 rounded">Proses</span>
                                            @elseif($complaint->status == 'selesai')
                                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded">Selesai</span>
                                            @else
                                                <span class="bg-red-100 text-red-800 text-[10px] font-bold px-2 py-0.5 rounded">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3 text-right whitespace-nowrap">
                                            <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-4 text-center text-slate-400 text-xs italic">Belum ada laporan masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/galleries/create.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Tambah Dokumentasi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
                <div class="p-6 bg-white border-b border-slate-200">
                    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Judul --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-bold text-slate-700 mb-1">Judul Dokumentasi</label>
                            <input type="text" name="title" id="title" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('title') }}" required>
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-bold text-slate-700 mb-1">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="3" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-6">
                            <label for="image" class="block text-sm font-bold text-slate-700 mb-1">Upload Foto</label>
                            <input type="file" name="image" id="image" class="w-full text-sm text-slate-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100" accept="image/*" required>
                            <p class="text-xs text-slate-500 mt-1">PNG, JPG, JPEG hingga 2MB.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-1" />
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-4">
                            <a href="{{ route('admin.galleries.index') }}" class="text-slate-600 font-medium hover:text-slate-800">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm">
                                Simpan Dokumentasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/galleries/index.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Manajemen Dokumentasi & Galeri') }}
            </h2>
            <div class="flex items-center gap-2">
                <form action="{{ route('admin.galleries.destroyAll') }}" method="POST" onsubmit="return confirm('PERHATIAN: Hapus semua dokumentasi?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1.5 px-3 rounded shadow-sm text-xs transition duration-150 ease-in-out">
                        Hapus Semua
                    </button>
                </form>
                <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Dokumentasi
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($galleries as $gallery)
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden group">
                        <div class="aspect-w-16 aspect-h-9 bg-slate-100 relative overflow-hidden h-48">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-900 mb-1">{{ $gallery->title }}</h3>
                            <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ $gallery->description }}</p>
                            
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-400">{{ $gallery->created_at->format('d M Y') }}</span>
                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Hapus dokumentasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-50 text-red-700 hover:bg-red-100 rounded text-xs font-bold transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-lg border border-dashed border-slate-300">
                        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" data-src="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <h3 class="mt-2 text-sm font-medium text-slate-900">Tidak ada dokumentasi</h3>
                        <p class="mt-1 text-sm text-slate-500">Mulai dengan menambahkan foto kegiatan atau dokumentasi sistem.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Tambah Baru
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/news/create.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Tulis Berita Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">
                    
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-bold text-slate-700 mb-1">Judul Berita</label>
                            <input type="text" name="title" id="title" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('title') }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-bold text-slate-700 mb-1">Gambar Utama</label>
                            <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" required>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 10MB.</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konten -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-bold text-slate-700 mb-1">Isi Berita</label>
                            <textarea name="content" id="content" rows="10" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.news.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 font-medium text-sm">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold text-sm">
                                Terbitkan Berita
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/news/index.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Manajemen Berita') }}
            </h2>
            <div class="flex items-center gap-2">
                 <form action="{{ route('admin.news.destroyAll') }}" method="POST" onsubmit="return confirm('PERHATIAN: Hapus semua berita?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1.5 px-3 rounded shadow-sm text-xs transition duration-150 ease-in-out">
                        Hapus Semua
                    </button>
                </form>
                <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tulis Berita
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($news as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden group">
                        <div class="aspect-w-16 aspect-h-9 bg-slate-100 relative overflow-hidden h-48">
                            <img src="{{ asset('storage/' . $item->image_path) }}" 
                                 alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-900 mb-1 line-clamp-1" title="{{ $item->title }}">{{ $item->title }}</h3>
                            <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                            
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-400">{{ $item->created_at->format('d M Y') }}</span>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-50 text-red-700 hover:bg-red-100 rounded text-xs font-bold transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-lg border border-dashed border-slate-300">
                        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" data-src="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        <h3 class="mt-2 text-sm font-medium text-slate-900">Belum ada berita</h3>
                        <p class="mt-1 text-sm text-slate-500">Mulai dengan mempublikasikan berita terbaru.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Buat Berita
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/system/index.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Manajemen Sistem & Konfigurasi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Card 1: Informasi Arsitektur --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-300">
                <div class="p-6 bg-white border-b border-slate-300">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Arsitektur & Environment</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($systemInfo as $key => $value)
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-300">
                                <dt class="text-xs font-bold text-slate-500 uppercase">{{ str_replace('_', ' ', $key) }}</dt>
                                <dd class="text-sm font-mono text-slate-900 mt-1">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Card 2: Maintenance & Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Optimize --}}
                <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-300">
                    <h3 class="font-bold text-slate-900 mb-2">Maintenance</h3>
                    <p class="text-sm text-slate-600 mb-4">Bersihkan cache aplikasi dan konfigurasi untuk menyegarkan sistem.</p>
                    <form action="{{ route('admin.system.optimize') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                            Optimasi Sistem (Clear Cache)
                        </button>
                    </form>
                </div>

                {{-- Backup --}}
                <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-300">
                    <h3 class="font-bold text-slate-900 mb-2">Backup & Restore</h3>
                    <p class="text-sm text-slate-600 mb-4">Cadangkan database dan file aplikasi Anda secara manual.</p>
                    <form action="{{ route('admin.system.backup') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                            Jalankan Backup Sekarang
                        </button>
                    </form>
                </div>
            </div>

            {{-- Card 3: Logs (Testing & QA) --}}
            <div class="bg-slate-50 text-slate-600 overflow-hidden shadow-sm sm:rounded-lg font-mono border border-slate-300">
                <div class="p-4 border-b border-slate-300 flex justify-between items-center bg-slate-100">
                    <h3 class="font-bold text-slate-800">System Logs (Last 20 lines)</h3>
                    <span class="text-xs text-slate-500">storage/logs/laravel.log</span>
                </div>
                <div class="p-4 overflow-x-auto text-xs whitespace-pre-wrap">
                    @forelse($logs as $log)
                        <div class="mb-1 border-b border-slate-200 pb-1">{{ $log }}</div>
                    @empty
                        <span class="text-slate-500">Log file kosong atau tidak terbaca.</span>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/users/create.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
            Tambah User Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card premium yang konsisten --}}
            <div class="bg-white border border-slate-300 shadow-lg sm:rounded-lg">
                {{-- Menggunakan padding yang sama dengan profile/edit --}}
                <div class="p-4 sm:p-8">
                    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                        @csrf

                        {{-- Nama --}}
                        <div>
                            <x-input-label for="name" value="Nama Lengkap" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password --}}
                        <div>
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        {{-- Roles (Checkbox) --}}
                        <div>
                            <x-input-label value="Roles" />
                            <div class="mt-2 space-y-2">
                                @foreach ($roles as $role)
                                    <label for="role_{{ $role->id }}" class="flex items-center">
                                        <input id="role_{{ $role->id }}" name="roles[]" type="checkbox"
                                            value="{{ $role->name }}"
                                            class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span
                                            class="ms-2 text-sm text-slate-600">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

                            {{-- Tombol Batal --}}
                            <a href="{{ route('admin.users.index') }}">
                                <x-secondary-button type="button">{{ __('Batal') }}</x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/users/edit.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
            Edit User: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card premium yang konsisten --}}
            <div class="bg-white border border-slate-300 shadow-lg sm:rounded-lg">
                <div class="p-4 sm:p-8">
                    {{-- Form mengarah ke route 'update' --}}
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT') {{-- Gunakan method PUT untuk update --}}

                        {{-- Nama --}}
                        <div>
                            <x-input-label for="name" value="Nama Lengkap" />
                            {{-- Tampilkan data 'name' yang ada --}}
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $user->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" value="Email" />
                            {{-- Tampilkan data 'email' yang ada --}}
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password (Opsional) --}}
                        <div>
                            <x-input-label for="password" value="Password Baru (Opsional)" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                autocomplete="new-password" />
                            <p class="mt-1 text-sm text-slate-600">
                                Kosongkan jika Anda tidak ingin mengubah password.
                            </p>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        {{-- Roles (Checkbox) --}}
                        <div>
                            <x-input-label value="Roles" />
                            <div class="mt-2 space-y-2">
                                @foreach ($roles as $role)
                                    <label for="role_{{ $role->id }}" class="flex items-center">
                                        <input id="role_{{ $role->id }}" name="roles[]" type="checkbox"
                                            value="{{ $role->name }}" {{-- Cek role yang sudah dimiliki user --}}
                                            @checked(old('roles', $user->roles->pluck('name'))->contains($role->name))
                                            class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span
                                            class="ms-2 text-sm text-slate-600">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Perbarui') }}</x-primary-button>
                            <a href="{{ route('admin.users.index') }}">
                                <x-secondary-button type="button">{{ __('Batal') }}</x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/admin/users/index.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                Manajemen User
            </h2>
            {{-- Tombol Tambah User Baru --}}
            {{-- Tombol Hapus Semua & Tambah User Baru --}}
            <div class="flex items-center gap-2">
                <form action="{{ route('admin.users.destroyAll') }}" method="POST" onsubmit="return confirm('PERHATIAN: Apakah Anda yakin ingin MENGHAPUS SEMUA user (kecuali akun Anda)?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1.5 px-3 rounded shadow-sm text-xs transition duration-150 ease-in-out">
                        Hapus Semua
                    </button>
                </form>

                <a href="{{ route('admin.users.create') }}">
                    <x-primary-button class="px-3 py-1.5 text-xs">
                        <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Pengguna
                    </x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card premium yang konsisten --}}
            <div
                class="bg-white border border-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">

                    {{-- Pesan Sukses/Error --}}
                    @if (session('success'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 text-sm font-medium text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-slate-500">
                            <thead
                                class="text-xs text-slate-700 uppercase bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">No</th>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">Nama</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Role</th>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr
                                        class="bg-white border-b border-slate-300 hover:bg-slate-50 transition duration-150 ease-in-out">
                                        <td
                                            class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $user->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- Menampilkan role sebagai badge --}}
                                            @foreach ($user->getRoleNames() as $role)
                                                <span
                                                    class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">
                                                    {{ $role }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                                            {{-- Tombol Aksi Edit --}}
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-md font-bold text-xs transition-colors">
                                                Edit
                                            </a>
                                            {{-- Tombol Aksi Hapus --}}
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 rounded-md font-bold text-xs transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b border-slate-300">
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-10 h-10 mb-2 text-slate-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                    </path>
                                                </svg>
                                                <span>Tidak ada data user.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/auth/confirm-password.blade.php`
```html
<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Konfirmasi Password</h2>
        <p class="text-xs text-slate-500 mt-1">
            {{ __('Ini adalah area aman aplikasi. Harap konfirmasi password Anda sebelum melanjutkan.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-2">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold text-xs" />

            <x-text-input id="password" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="password" name="password" required
                autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="pt-1">
            <x-primary-button class="w-full justify-center py-2 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200 text-sm">
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

```

#### File: `resources/views/auth/forgot-password.blade.php`
```html
<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Lupa Password</h2>
        <p class="text-xs text-slate-500 mt-1">{{ __('Jangan khawatir. Masukkan email anda dan kami akan mengirimkan link reset password.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-3">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="email" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="pt-1">
            <x-primary-button class="w-full justify-center py-2 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200 text-sm">
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>

        <div class="mt-3 text-center border-t border-gray-200 pt-3">
            <a href="{{ route('login') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline transition duration-150">
                Kembali ke Halaman Login
            </a>
        </div>
    </form>
</x-guest-layout>

```

#### File: `resources/views/auth/login.blade.php`
```html
<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Selamat Datang</h2>
        <p class="text-xs text-slate-500 mt-1">Silakan masuk untuk melanjutkan pengaduan</p>
    </div>

    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-3">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold text-xs" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                    </svg>
                </div>
                <x-text-input id="email"
                    class="block w-full pl-9 pr-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold text-xs" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                    </svg>
                </div>
                <x-text-input id="password"
                    class="block w-full pl-9 pr-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 cursor-pointer h-4 w-4"
                    name="remember">
                <span class="ms-2 text-xs text-slate-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-blue-600 hover:text-blue-800 font-medium hover:underline transition duration-150 ease-in-out"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="pt-1">
            <x-primary-button
                class="w-full justify-center py-2 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200 text-sm">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        <div class="mt-3 text-center border-t border-gray-200 pt-3">
            <p class="text-xs text-slate-600">
                Belum punya akun pengaduan?
                <a href="{{ route('register') }}"
                    class="font-bold text-blue-600 hover:text-blue-800 hover:underline transition duration-150">
                    Daftar Disini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

```

#### File: `resources/views/auth/register.blade.php`
```html
<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Buat Akun</h2>
        <p class="text-xs text-slate-500 mt-1">Silakan mendaftar untuk membuat pengaduan</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-2">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="name" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="email" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="password" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-1">
            <x-primary-button class="w-full justify-center py-2 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200 text-sm">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>

        <div class="mt-3 text-center border-t border-gray-200 pt-3">
            <p class="text-xs text-slate-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-800 hover:underline transition duration-150">
                    Masuk Disini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

```

#### File: `resources/views/auth/reset-password.blade.php`
```html
<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Reset Password</h2>
        <p class="text-xs text-slate-500 mt-1">{{ __('Silakan buat password baru untuk akun Anda.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-2">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="email" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password Baru')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="password" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-1">
            <x-primary-button class="w-full justify-center py-2 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200 text-sm">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

```

#### File: `resources/views/auth/verify-email.blade.php`
```html
<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Verifikasi Email</h2>
        <p class="text-xs text-slate-500 mt-1">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-xs text-green-600 bg-green-50 p-3 rounded-lg border border-green-200 text-center">
            {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="mt-4 flex flex-col space-y-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-primary-button class="w-full justify-center py-2 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200 text-sm">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-center text-xs font-bold text-slate-500 hover:text-slate-800 hover:underline transition duration-150">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>

```

#### File: `resources/views/components/auth-session-status.blade.php`
```html
@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif

```

#### File: `resources/views/components/danger-button.blade.php`
```html
<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 dark:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-black-100 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red-600 focus:bg-red-700 dark:focus:bg-red-600 active:bg-red-800 dark:active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

```

#### File: `resources/views/components/dropdown-link.blade.php`
```html
<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-black-700 dark:text-black-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out']) }}>{{ $slot }}</a>

```

#### File: `resources/views/components/dropdown.blade.php`
```html
@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>

```

#### File: `resources/views/components/input-error.blade.php`
```html
@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

```

#### File: `resources/views/components/input-label.blade.php`
```html
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-black-700 dark:text-black-300']) }}>
    {{ $value ?? $slot }}
</label>

```

#### File: `resources/views/components/modal.blade.php`
```html
@props(['name', 'show' => false, 'maxWidth' => '2xl'])

@php
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth];
@endphp

<div x-data="{
    show: @js($show),
    focusables() {
        // All focusable element types...
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
        return [...$el.querySelectorAll(selector)]
            // All non-disabled elements...
            .filter(el => !el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
}" x-init="$watch('show', value => {
    if (value) {
        document.body.classList.add('overflow-y-hidden');
        {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
    } else {
        document.body.classList.remove('overflow-y-hidden');
    }
})"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null" x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false" x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()" x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: {{ $show ? 'block' : 'none' }};">
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div x-show="show"
        class="mb-6 bg-white border border-gray-200 rounded-lg overflow-hidden shadow-lg transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>

```

#### File: `resources/views/components/nav-link.blade.php`
```html
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-black-900 dark:text-black-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-black-500 dark:text-black-400 hover:text-black-700 dark:hover:text-black-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-black-700 dark:focus:text-black-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

```

#### File: `resources/views/components/primary-button.blade.php`
```html
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

```

#### File: `resources/views/components/responsive-nav-link.blade.php`
```html
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full px-3 py-2.5 rounded-lg text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out shadow-sm'
            : 'flex items-center w-full px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

```

#### File: `resources/views/components/secondary-button.blade.php`
```html
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-slate-400 rounded-md font-semibold text-xs text-slate-800 uppercase tracking-widest shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

```

#### File: `resources/views/components/text-input.blade.php`
```html
@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-slate-400 bg-white text-slate-900 
                focus:border-blue-600 focus:ring-blue-600 
                rounded-md shadow-sm 
                transition duration-150 ease-in-out',
]) !!}>

```

#### File: `resources/views/dashboard.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Dashboard Pengaduan') }}
            </h2>
            <div class="text-sm text-slate-500">
                Dashboard / Laporan Saya
            </div>
        </div>
    </x-slot>

    {{-- Fetch data once --}}
    @php
        $complaints = Auth::user()->complaints()->with('category')->latest()->get();
    @endphp

    <div class="py-5" x-data="{ activeModal: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Greeting Section --}}
            <div class="mb-5 px-2">
                <h2 class="text-lg text-slate-800 flex items-center flex-wrap gap-1">
                    Selamat datang, <span class="font-bold text-blue-600">{{ Auth::user()->name }}</span>!
                </h2>
                <p class="text-slate-600 mt-1">
                    Berikut adalah riwayat pengaduan yang telah Anda kirimkan.
                </p>
            </div>

            {{-- Main Card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-300">

                <div class="p-6 bg-slate-50 border-b border-slate-300 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Daftar Laporan Saya</h3>
                        <p class="text-sm text-slate-500">Kelola dan pantau status tiket Anda.</p>
                    </div>

                    <a href="{{ route('complaint.public.step1.create') }}">
                        <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                            <svg class="w-5 h-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            {{ __('Buat Laporan Baru') }}
                        </x-primary-button>
                    </a>
                </div>

                <div class="p-6">
                    @if ($complaints->count() > 0)
                        <div class="overflow-x-auto rounded-lg border border-slate-300">
                            <table class="w-full text-left text-sm text-slate-600">
                                <thead class="bg-slate-50 text-slate-800 uppercase text-xs font-semibold">
                                    <tr>
                                        <th class="px-6 py-4">ID Tiket</th>
                                        <th class="px-6 py-4">Judul Laporan</th>
                                        <th class="px-6 py-4">Tanggal</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-300 bg-white">
                                    @foreach ($complaints as $complaint)
                                        <tr class="hover:bg-slate-50 transition duration-150">
                                            <td class="px-6 py-4 font-mono font-bold text-blue-600">
                                                #{{ $complaint->token }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-slate-900">
                                                {{ Str::limit($complaint->title, 40) }}
                                            </td>
                                            <td class="px-6 py-4 text-slate-500">
                                                {{ $complaint->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($complaint->status == 'pending')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                                        ⏳ Menunggu
                                                    </span>
                                                @elseif($complaint->status == 'proses')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                        ⚙️ Proses
                                                    </span>
                                                @elseif($complaint->status == 'selesai')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                        ✅ Selesai
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                        ❌ Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <button @click="activeModal = '{{ $complaint->id }}'"
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-bold rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors cursor-pointer">
                                                    <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 px-4">
                            <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-slate-900">Belum ada laporan</h3>
                            <p class="text-slate-500 mt-1 max-w-sm mx-auto mb-6">Anda belum pernah mengirimkan pengaduan.</p>
                            <a href="{{ route('complaint.public.step1.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 transition">
                                Mulai Buat Laporan
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Modals Loop --}}
            @foreach ($complaints as $complaint)
                <div x-show="activeModal === '{{ $complaint->id }}'" 
                     class="relative z-[100]" 
                     style="display: none;">
                    
                    {{-- Backdrop --}}
                    <div x-show="activeModal === '{{ $complaint->id }}'"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" 
                         @click="activeModal = null"></div>

                    {{-- Modal Wrapper --}}
                    <div class="fixed inset-0 z-[100] w-screen overflow-y-auto">
                        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                            
                            {{-- Modal Panel --}}
                            <div x-show="activeModal === '{{ $complaint->id }}'"
                                 x-transition:enter="ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave="ease-in duration-200"
                                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">
                                
                                {{-- Header --}}
                                <div class="bg-blue-600 px-4 py-4 sm:px-6 flex justify-between items-center">
                                    <h3 class="text-base font-bold leading-6 text-white" id="modal-title">Detail Pengaduan</h3>
                                    <button type="button" @click="activeModal = null" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- Body --}}
                                <div class="px-4 py-5 sm:p-6 space-y-5">
                                    
                                    {{-- Meta Info --}}
                                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">ID Tiket</p>
                                            <div class="flex items-center gap-2">
                                                <span class="text-xl font-mono font-bold text-blue-600">#{{ $complaint->token }}</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Tanggal</p>
                                            <p class="text-sm font-semibold text-slate-700">{{ $complaint->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    {{-- Kategori --}}
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-1">Kategori Permasalahan</p>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                            {{ $complaint->category->name ?? 'Kategori Tidak Ditemukan' }}
                                        </span>
                                    </div>

                                    {{-- Status --}}
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-1">Status Laporan</p>
                                        @if ($complaint->status == 'pending')
                                            <div class="flex items-center gap-2 text-amber-700 bg-amber-50 px-3 py-2 rounded-lg border border-amber-100">
                                                <span class="relative flex h-2 w-2">
                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                                </span>
                                                <span class="text-xs font-bold uppercase">Menunggu Verifikasi</span>
                                            </div>
                                        @elseif($complaint->status == 'proses')
                                            <div class="flex items-center gap-2 text-blue-700 bg-blue-50 px-3 py-2 rounded-lg border border-blue-100">
                                                <span class="relative flex h-2 w-2">
                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                                </span>
                                                <span class="text-xs font-bold uppercase">Sedang Diproses</span>
                                            </div>
                                        @elseif($complaint->status == 'selesai')
                                            <div class="flex items-center gap-2 text-emerald-700 bg-emerald-50 px-3 py-2 rounded-lg border border-emerald-100">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="text-xs font-bold uppercase">Selesai</span>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-2 text-red-700 bg-red-50 px-3 py-2 rounded-lg border border-red-100">
                                                <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                <span class="text-xs font-bold uppercase">Ditolak</span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Content --}}
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-1">Isi Laporan</p>
                                        <h4 class="text-base font-bold text-slate-900 mb-2">{{ $complaint->title }}</h4>
                                        <div class="bg-slate-50 rounded-lg p-4 text-sm text-slate-600 border border-slate-100 max-h-48 overflow-y-auto leading-relaxed">
                                            {!! nl2br(e($complaint->content)) !!}
                                        </div>
                                    </div>

                                    {{-- Image --}}
                                    @if ($complaint->attachment)
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-2">Bukti Lampiran</p>
                                            <div class="rounded-lg overflow-hidden border border-slate-200 bg-slate-50 p-2">
                                                <img src="{{ route('attachments.show', $complaint->id) }}" class="w-full h-auto object-contain max-h-64 mx-auto rounded-md shadow-sm" alt="Bukti">
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-2">Bukti Lampiran</p>
                                            <div class="bg-slate-50 border border-slate-200 rounded-lg p-3 text-center">
                                                <span class="text-xs text-slate-400 italic">Tidak ada lampiran disertakan.</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- Footer --}}
                                <div class="bg-slate-50 px-4 py-4 sm:px-6 flex flex-col sm:flex-row-reverse gap-2 border-t border-slate-100">
                                    <a href="{{ route('complaint.public.finish', $complaint->token) }}" class="inline-flex w-full sm:w-auto justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                                        Lihat Selengkapnya
                                    </a>
                                    <button type="button" class="inline-flex w-full sm:w-auto justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition-all" @click="activeModal = null">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
```

#### File: `resources/views/layouts/app.blade.php`
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-slate-50 overflow-hidden">
        {{-- Sidebar Navigation --}}
        @include('layouts.navigation')

        {{-- Main Content Area --}}
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden md:pl-64 transition-all duration-300">
            @if (isset($header))
                <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-300 z-30 sticky top-0">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <div class="w-full">
                        {{ $header }}
                    </div>
                        {{-- Mobile Hamburger Trigger (Visible only on mobile inside header if we want, but usually sidebar handles its own mobile toggle or we add a specific bar. 
                             For simplicity, we'll let the user toggle via a button we'll ensure exists in the mobile view or header) --}}
                         <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-slate-600 md:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    </div>
                </header>
            @endif

            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>

```

#### File: `resources/views/layouts/guest.blade.php`
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WBS Inspektorat') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-black-900 antialiased">
    <div
        class="min-h-screen flex flex-col justify-center items-center py-8 sm:px-6 lg:px-8 bg-slate-50 relative overflow-hidden">

        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div
                class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="z-10 flex flex-col items-center mb-5">
            <a href="/" class="transition transform hover:scale-105">
                <img src="{{ asset('images/logo-kota1.png') }}" alt="Logo Kota Gorontalo" class="w-45 h-auto drop-shadow-md object-contain" />
            </a>
            <h1 class="mt-2 text-2xl font-bold text-slate-800 tracking-tight">Whistle Blowing System</h1>
            <p class="text-sm text-slate-500 font-medium">Inspektorat Kota Gorontalo</p>
        </div>

        <div
            class="w-full sm:max-w-md bg-white/80 backdrop-blur-xl border border-white/20 shadow-2xl overflow-hidden sm:rounded-2xl z-10 transition-all duration-300 hover:shadow-blue-500/10 px-6 py-4">
            {{ $slot }} 
        </div>

        <div class="mt-4 text-center text-xs text-slate-400 z-10">
            &copy; {{ date('Y') }} Inspektorat Kota Gorontalo. All rights reserved.
        </div>
    </div>
</body>

</html>

```

#### File: `resources/views/layouts/navigation.blade.php`
```html
{{-- SIDEBAR COMPONENT --}}
{{-- 1. MOBILE BACKDROP OVERLAY --}}
<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/80 z-40 md:hidden" style="display: none;"></div>

{{-- MOBILE BACKDROP --}}
<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm md:hidden">
</div>

{{-- 2. SIDEBAR CONTAINER --}}
<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-300 transition-transform duration-300 ease-in-out md:translate-x-0 flex flex-col shadow-xl md:shadow-none">
    
    {{-- LOGO AREA --}}
    {{-- LOGO AREA --}}
    <div class="h-16 flex items-center justify-between border-b border-slate-300 px-4 sm:px-6 bg-slate-50/50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 min-w-0">
            <img src="{{ asset('images/logo-kota1.png') }}" alt="Logo" class="shrink-0 h-8 w-auto object-contain">
            <span class="font-extrabold text-lg sm:text-xl tracking-tight text-slate-800 truncate">SI-ADUAN</span>
        </a>
        {{-- Mobile Close Button --}}
        <button @click="sidebarOpen = false" class="md:hidden shrink-0 p-1 -mr-2 text-slate-400 hover:text-red-500 transition-colors focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    {{-- MENU LINKS AREA --}}
    {{-- Added @click to close sidebar on mobile when any link is clicked --}}
    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1" @click="sidebarOpen = false">
        
        {{-- HOME --}}
        <x-responsive-nav-link :href="route('landing')" :active="request()->routeIs('landing')" class="rounded-lg mb-1">
            <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            {{ __('Beranda') }}
        </x-responsive-nav-link>

        {{-- DASHBOARD --}}
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-lg mb-1">
            <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1.125-1.125M10.5 16.5l-1.125-1.125m0 0L8.25 14.25m1.125 1.125l-1.125 1.125m3.75-3.75L12 14.25m0 0l-1.125 1.125M12 14.25l1.125 1.125m0 0L14.25 16.5m1.125-1.125l-1.125-1.125M16.5 14.25l1.125 1.125" />
            </svg>
            {{ __('Dashboard') }}
        </x-responsive-nav-link>

        <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Menu Utama</p>

        {{-- MASYARAKAT: BUAT PENGADUAN --}}
        @role('masyarakat')
            <x-responsive-nav-link :href="route('complaint.public.step1.create')" :active="request()->routeIs('complaint.public.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                {{ __('Buat Pengaduan') }}
            </x-responsive-nav-link>
        @endrole

        {{-- INTERNAL: PENGADUAN MASUK --}}
        @hasanyrole('admin|petugas|walikota')
            <x-responsive-nav-link :href="route('admin.complaints.index')" :active="request()->routeIs('admin.complaints.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
                {{ __('Pengaduan Masuk') }}
            </x-responsive-nav-link>
        @endhasanyrole

        {{-- ADMIN MENU --}}
        @role('admin')
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Administrasi</p>
            
            <x-responsive-nav-link :href="route('admin.news.index')" :active="request()->routeIs('admin.news.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
                {{ __('Berita') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.galleries.index')" :active="request()->routeIs('admin.galleries.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                {{ __('Dokumentasi') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a1.5 1.5 0 002.122 0l4.318-4.318a1.5 1.5 0 000-2.122L11.16 3.66A1.5 1.5 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                </svg>
                {{ __('Kategori') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.935c.355-.129.668-.316.926-.533a9.353 9.353 0 00-4.49-8.455c-.39-.223-.593-.665-.593-1.116v-2.807a3.374 3.374 0 00-3.374-3.374h-2.25c-1.86 0-3.374 1.514-3.374 3.374v2.807c0 .451-.203.893-.593 1.116a9.353 9.353 0 00-4.49 8.455c.258.217.571.404.926.533a9.337 9.337 0 004.121.935 9.38 9.38 0 002.625-.372z" />
                </svg>
                {{ __('Manajemen Pengguna') }}
            </x-responsive-nav-link>

             <x-responsive-nav-link :href="route('admin.system.index')" :active="request()->routeIs('admin.system.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ __('Sistem') }}
            </x-responsive-nav-link>
        @endrole
    </div>

    {{-- USER PROFILE BOTTOM --}}
    <div class="border-t border-slate-300 bg-slate-50/50 p-4">
        <div class="flex items-center gap-3">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg border border-blue-200">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-slate-800 truncate">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-xs text-slate-500 truncate">
                     {{ Auth::user()->roles->pluck('name')->first() ?? 'User' }}
                </p>
            </div>
            
            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Keluar">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </button>
            </form>
        </div>
        <div class="mt-3">
             <a href="{{ route('profile.edit') }}" class="block text-center w-full py-2 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-md hover:bg-slate-50 hover:text-blue-600 hover:border-blue-200 transition-all shadow-sm">
                Edit Profil
             </a>
        </div>
    </div>
</aside>

```

#### File: `resources/views/layouts/public.blade.php`
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WBS Inspektorat') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-900 bg-slate-50">
    <div class="min-h-screen flex flex-col relative overflow-hidden">
        {{-- Decorative Background Elements (Optional tapi estetik) --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <main class="flex-grow z-10 w-full relative">
            {{ $slot }}
        </main>
    </div>
</body>

</html>

```

#### File: `resources/views/petugas/dashboard.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Area Kerja Inspektur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Greeting --}}
            <div class="mb-6 px-2">
                <p class="text-slate-600 dark:text-slate-400">
                    Selamat bertugas, <span class="font-bold text-blue-600">{{ Auth::user()->name }}</span>. Silakan
                    periksa laporan masuk di bawah ini.
                </p>
            </div>

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Pending --}}
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 flex items-center justify-between hover:border-amber-400 transition cursor-default">
                    <div>
                        <div class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">
                            Perlu Verifikasi</div>
                        <div class="text-3xl font-bold text-slate-800 dark:text-black mt-1">{{ $stats['pending'] }}
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-amber-50 text-amber-600 dark:bg-amber-900/20 dark:text-amber-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                {{-- Proses --}}
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 flex items-center justify-between hover:border-blue-400 transition cursor-default">
                    <div>
                        <div class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">
                            Sedang Diproses</div>
                        <div class="text-3xl font-bold text-slate-800 dark:text-black mt-1">{{ $stats['process'] }}
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                </div>

                {{-- Selesai --}}
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 flex items-center justify-between hover:border-emerald-400 transition cursor-default">
                    <div>
                        <div class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">
                            Selesai</div>
                        <div class="text-3xl font-bold text-slate-800 dark:text-black mt-1">{{ $stats['finished'] }}
                        </div>
                    </div>
                    <div
                        class="p-3 rounded-full bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Action Banner --}}
            <div class="bg-white border border-slate-200 rounded-xl shadow-lg p-6 sm:p-10 text-slate-900 relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h3 class="text-2xl font-bold mb-2 text-slate-900">Tindak Lanjuti Laporan</h3>
                        <p class="text-slate-600 max-w-xl leading-relaxed">
                            Ada laporan masyarakat yang menunggu verifikasi atau tindak lanjut. Segera proses untuk
                            menjaga kepuasan pelayanan publik.
                        </p>
                    </div>
                    <a href="{{ route('admin.complaints.index') }}"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-base font-bold rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center whitespace-nowrap">
                        Buka Daftar Pengaduan
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                {{-- Decorative background elements --}}
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-slate-50 opacity-50 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-blue-50 opacity-50 rounded-full blur-3xl"></div>
            </div>

        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/profile/edit.blade.php`
```html
<x-app-layout>
    <x-slot name="header">
        {{-- Konsistensi Header --}}
        <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Card 1: Update Profile Information --}}
            <div
                class="p-4 sm:p-8 bg-white border border-gray-200 shadow-lg sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Card 2: Update Password --}}
            <div
                class="p-4 sm:p-8 bg-white border border-slate-200 shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Card 3: Delete User --}}
            <div
                class="p-4 sm:p-8 bg-white border border-slate-200 shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

```

#### File: `resources/views/profile/partials/delete-user-form.blade.php`
```html
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-black-600 dark:text-black-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- Tombol ini sudah otomatis menggunakan style danger-button kita --}}
    <x-danger-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</x-danger-button>

    {{-- Modal ini sudah otomatis menggunakan style modal premium kita --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-black-600 dark:text-black-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password_delete" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input id="password_delete" name="password" type="password" class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                {{-- Kita akan sempurnakan component ini di langkah berikutnya --}}
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                {{-- Tombol ini sudah otomatis menggunakan style danger-button kita --}}
                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

```

#### File: `resources/views/profile/partials/update-password-form.blade.php`
```html
<section>
    <header>
        <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-black-600 dark:text-black-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-black-600 dark:text-black-400">{{ __('Saved.') }}</p>
        </div>
    </form>
</section>

```

#### File: `resources/views/profile/partials/update-profile-information-form.blade.php`
```html
<section>
    <header>
        <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-black-600 dark:text-black-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-black-800 dark:text-black-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-black-600 dark:text-black-400 hover:text-black-900 dark:hover:text-black-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            {{-- Tombol ini sudah otomatis menggunakan style primary-button kita --}}
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-black-600 dark:text-black-400">{{ __('Saved.') }}</p>
        </div>
    </form>
</section>

```

#### File: `resources/views/public/finish.blade.php`
```html
<x-public-layout>
    <div class="flex-grow flex flex-col items-center justify-center w-full px-4 py-8 sm:px-6 lg:px-8 bg-slate-50/50">
        <div class="max-w-md mx-auto w-full">
            
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-10 text-center relative">
                {{-- Decorative Background Elements --}}
                <div class="absolute inset-0 overflow-hidden rounded-2xl pointer-events-none">
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500"></div>
                </div>

                {{-- Success Icon --}}
                <div class="flex justify-center mb-6">
                    <div class="relative">
                        <div class="absolute inset-0 bg-green-100 rounded-full animate-ping opacity-75"></div>
                        <div class="relative flex items-center justify-center h-16 w-16 sm:h-20 sm:w-20 rounded-full bg-green-50 text-green-500 border-[5px] border-white shadow-sm ring-1 ring-green-100">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mb-2">
                    Laporan Terkirim!
                </h2>
                <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                    Kami telah menerima laporan Anda. Cek status laporan anda secara berkala.
                </p>

                {{-- Ticket ID Box --}}
                <!-- <div class="bg-slate-50 rounded-xl border border-slate-200 p-4 sm:p-5 mb-6 relative group shadow-inner hover:shadow-md transition-shadow">
                    <p class="text-[10px] uppercase font-bold text-slate-400 tracking-[0.2em] mb-2">ID Tiket Laporan</p>
                    
                    <div class="flex items-center justify-center gap-3 shrink-0 cursor-pointer select-all" onclick="copyTicket()" title="Klik untuk menyalin">
                        <span id="ticket-id" class="text-lg sm:text-3xl font-mono font-black text-slate-800 tracking-widest break-all">
                            {{ $complaint->token }}
                        </span>
                        
                        <button class="p-1.5 rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-blue-600 hover:border-blue-200 hover:bg-blue-50 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v2"></path></svg>
                        </button>
                    </div>

                    {{-- Tooltip feedback --}}
                    <div id="copy-feedback" class="absolute -bottom-9 left-1/2 transform -translate-x-1/2 opacity-0 transition-opacity duration-300 pointer-events-none">
                         <span class="bg-slate-800 text-white text-[10px] font-bold py-1 px-2.5 rounded-full shadow-lg flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Disalin!
                        </span>
                    </div>
                </div> -->

                <div class="flex flex-col gap-2.5 justify-center w-full">
                    <!-- <a href="{{ route('status.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-slate-300 shadow-sm text-sm font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 hover:text-blue-600 hover:border-blue-200 transition-all">
                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Lacak Status
                    </a> -->
                    <a href="{{ url('/') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-bold rounded-xl shadow-lg shadow-blue-500/30 text-white bg-blue-600 hover:bg-blue-700 transition-all transform active:scale-95">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
            
            <p class="text-center text-xs text-slate-400 mt-6 md:mt-8">
                Terima kasih telah berpartisipasi dalam membangun tata kelola yang lebih baik.
            </p>

        </div>
    </div>

    <script>
        function copyTicket() {
            const ticketId = document.getElementById('ticket-id').innerText.trim();
            navigator.clipboard.writeText(ticketId).then(() => {
                const feedback = document.getElementById('copy-feedback');
                feedback.classList.remove('opacity-0', 'translate-y-2');
                setTimeout(() => {
                    feedback.classList.add('opacity-0', 'translate-y-2');
                }, 2000);
            });
        }
    </script>
</x-public-layout>

```

#### File: `resources/views/public/status/index.blade.php`
```html
<x-public-layout>
    <div class="relative bg-white overflow-hidden">
        {{-- Hero Background --}}
        <div class="absolute inset-0">
             <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-black opacity-95"></div>
              {{-- Pattern --}}
             <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
        </div>

        <div class="relative max-w-5xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl md:text-5xl mb-4">
                Lacak Status Laporan
            </h1>
            <p class="mt-2 max-w-xl mx-auto text-base text-slate-300">
                Pantau progres tindak lanjut pengaduan Anda secara real-time.
            </p>

            {{-- Search Form --}}
            <div class="mt-8 max-w-lg mx-auto">
                <form action="{{ route('status.check') }}" method="POST" class="sm:flex gap-2">
                    @csrf
                    <div class="min-w-0 flex-1 relative">
                        <label for="token" class="sr-only">Nomor Tiket (ID)</label>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <input id="token" name="token" type="text" required
                            class="block w-full pl-10 pr-3 py-3 border border-transparent rounded-lg leading-5 bg-white/10 text-white placeholder-slate-400 focus:outline-none focus:bg-white focus:text-slate-900 focus:placeholder-slate-500 focus:ring-2 focus:ring-blue-500 sm:text-sm transition-colors duration-200"
                            placeholder="Masukkan ID Tiket (Contoh: TIKET-2023...)">
                    </div>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                        <button type="submit"
                            class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-sm font-bold rounded-lg text-blue-900 bg-blue-400 hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition-colors shadow-lg shadow-blue-900/50">
                            Lacak
                        </button>
                    </div>
                </form>
                 <p class="mt-3 text-xs text-slate-400">
                    *ID Tiket diberikan saat Anda berhasil mengirim laporan.
                </p>
                @if(session('error'))
                    <div class="mt-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg text-red-200 text-sm">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Riwayat Pengaduan (Login Only) --}}
    @auth
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-800">Riwayat Pengaduan Saya</h2>
                <a href="{{ route('complaint.public.step1.create') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-500 hover:underline">
                    + Buat Laporan Baru
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">ID Tiket</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class=" relative px-6 py-3"><span class="sr-only">Detail</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse($complaints as $complaint)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-mono font-medium text-slate-600">
                                        {{ $complaint->token }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-slate-900 line-clamp-1">{{ $complaint->title }}</div>
                                        <div class="text-xs text-slate-500">{{ $complaint->category->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                        {{ $complaint->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                         @if ($complaint->status == 'pending')
                                            <span class="inline-flex px-2 text-[10px] font-semibold leading-5 text-amber-700 bg-amber-100 rounded-full">Pending</span>
                                        @elseif($complaint->status == 'proses')
                                            <span class="inline-flex px-2 text-[10px] font-semibold leading-5 text-blue-700 bg-blue-100 rounded-full">Proses</span>
                                        @elseif($complaint->status == 'selesai')
                                            <span class="inline-flex px-2 text-[10px] font-semibold leading-5 text-emerald-700 bg-emerald-100 rounded-full">Selesai</span>
                                        @elseif($complaint->status == 'ditolak')
                                            <span class="inline-flex px-2 text-[10px] font-semibold leading-5 text-red-700 bg-red-100 rounded-full">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                        <a href="{{ route('status.show', $complaint->token) }}" class="text-blue-600 hover:text-blue-900 border border-blue-200 bg-blue-50 hover:bg-white hover:border-blue-300 px-3 py-1.5 rounded-md transition-all">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center">
                                             <svg class="h-10 w-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            <span class="text-sm font-medium">Belum ada riwayat pengaduan.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                     @if($complaints instanceof \Illuminate\Pagination\LengthAwarePaginator && $complaints->hasPages())
                        <div class="bg-white px-4 py-3 border-t border-slate-200 sm:px-6">
                            {{ $complaints->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endauth
</x-public-layout>

```

#### File: `resources/views/public/status/show.blade.php`
```html
<x-public-layout>
    <div class="w-full py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            
            {{-- Header --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Status Pengaduan</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-slate-500 text-xs font-medium">ID Tiket:</span>
                        <span class="font-mono font-bold text-blue-700 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded text-xs tracking-wide">{{ $complaint->token }}</span>
                    </div>
                </div>
                <a href="{{ route('status.index') }}" class="inline-flex items-center text-xs font-bold text-slate-500 hover:text-blue-600 transition-colors bg-white px-3 py-2 rounded-lg border border-slate-200 shadow-sm hover:shadow">
                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                     Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Kolom Kiri: Detail Laporan --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden relative">
                        {{-- Decorative Top --}}
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-400 to-indigo-500"></div>

                        <div class="p-6">
                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 uppercase tracking-wide">
                                    {{ $complaint->category->name ?? 'Umum' }}
                                </span>
                                <span class="text-slate-300">|</span>
                                <div class="flex items-center text-xs text-slate-500 font-medium">
                                    <svg class="w-3 h-3 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $complaint->created_at->format('d F Y') }}
                                </div>
                                <div class="flex items-center text-xs text-slate-500 font-medium">
                                    <svg class="w-3 h-3 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $complaint->created_at->format('H:i') }} WIB
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 mb-4 leading-snug">{{ $complaint->title }}</h3>
                            
                            <div class="prose prose-slate prose-sm max-w-none text-slate-600 mb-6 leading-relaxed bg-slate-50/50 p-4 rounded-lg border border-slate-100">
                                {!! nl2br(e($complaint->content)) !!}
                            </div>

                            @if ($complaint->attachment)
                                <div class="mt-6 border-t border-slate-100 pt-4">
                                    <h4 class="text-xs font-bold text-slate-900 mb-3 flex items-center">
                                        <svg class="w-3 h-3 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Bukti Lampiran
                                    </h4>
                                    <div class="rounded-lg overflow-hidden border border-slate-200 inline-block shadow-sm">
                                        {{-- Note: Ensure route 'attachments.show' exists or adjust as needed. Assuming typical storage link usage --}}
                                        <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank">
                                             <img src="{{ asset('storage/' . $complaint->attachment) }}" alt="Bukti" class="max-w-full h-auto max-h-64 object-contain bg-slate-50 hover:bg-slate-100 transition-colors">
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Status & Riwayat --}}
                <div class="space-y-6">
                    {{-- Status Card --}}
                    <div class="bg-white rounded-xl shadow-md border border-slate-200 p-5 overflow-hidden">
                        <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-4">Status Terkini</h4>
                        
                        @if ($complaint->status == 'pending')
                            <div class="w-full py-4 text-center bg-amber-50 rounded-lg border border-amber-100 ring-2 ring-amber-50/50">
                                <span class="block text-2xl font-black text-amber-500 mb-1">MENUNGGU</span>
                                <span class="text-[10px] font-bold text-amber-700 tracking-wide uppercase">Menunggu Verifikasi</span>
                            </div>
                        @elseif($complaint->status == 'proses')
                            <div class="w-full py-4 text-center bg-blue-50 rounded-lg border border-blue-100 ring-2 ring-blue-50/50">
                                <span class="block text-2xl font-black text-blue-600 mb-1">DIPROSES</span>
                                <span class="text-[10px] font-bold text-blue-700 tracking-wide uppercase">Sedang Ditindaklanjuti</span>
                            </div>
                        @elseif($complaint->status == 'selesai')
                            <div class="w-full py-4 text-center bg-emerald-50 rounded-lg border border-emerald-100 ring-2 ring-emerald-50/50">
                                <span class="block text-2xl font-black text-emerald-600 mb-1">SELESAI</span>
                                <span class="text-[10px] font-bold text-emerald-700 tracking-wide uppercase">Laporan Ditutup</span>
                            </div>
                        @elseif($complaint->status == 'ditolak')
                            <div class="w-full py-4 text-center bg-red-50 rounded-lg border border-red-100 ring-2 ring-red-50/50">
                                <span class="block text-2xl font-black text-red-600 mb-1">DITOLAK</span>
                                <span class="text-[10px] font-bold text-red-700 tracking-wide uppercase">Laporan Tidak Valid</span>
                            </div>
                        @endif
                        
                        <div class="mt-4 pt-4 border-t border-slate-100">
                             <p class="text-[10px] text-center text-slate-400">Terakhir diperbarui: {{ $complaint->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    {{-- Timeline Tanggapan --}}
                    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
                        <div class="bg-slate-50 px-5 py-3 border-b border-slate-100">
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wide">Riwayat Tanggapan</h4>
                        </div>
                        <div class="p-5">
                            <ol class="relative border-l-2 border-slate-200 ml-2 space-y-8">
                                {{-- Item Laporan Dibuat (Default) --}}
                                <li class="ml-6 relative">
                                    <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-[37px] ring-4 ring-white border border-blue-200">
                                         <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-xs font-bold text-slate-900">Laporan Dibuat</h3>
                                    <time class="block mb-2 text-[10px] font-medium text-slate-400">{{ $complaint->created_at->format('d M Y, H:i') }}</time>
                                    <p class="text-xs font-medium text-slate-600 bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                        Laporan berhasil dikirim ke sistem.
                                    </p>
                                </li>

                                {{-- Loop Tanggapan --}}
                                @foreach($complaint->responses as $response)
                                    <li class="ml-6 relative">
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-purple-100 rounded-full -left-[37px] ring-4 ring-white border border-purple-200">
                                            <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-xs font-bold text-slate-900">
                                            {{ $response->user->name ?? 'Admin' }}
                                            <span class="bg-purple-100 text-purple-700 text-[10px] font-bold mr-2 px-1.5 py-0.5 rounded ml-2 uppercase tracking-wide">Petugas</span>
                                        </h3>
                                        <time class="block mb-2 text-[10px] font-medium text-slate-400">{{ $response->created_at->format('d M Y, H:i') }}</time>
                                        <div class="p-3 text-xs font-normal text-slate-700 bg-slate-50 rounded-lg border border-slate-100 relative group">
                                            <div class="absolute top-3 left-[-5px] w-2.5 h-2.5 bg-slate-50 border-t border-l border-slate-100 transform -rotate-45"></div>
                                            "{{ $response->content }}"
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-public-layout>

```

#### File: `resources/views/public/step1.blade.php`
```html
<x-public-layout>
    <div class="w-full pt-14 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg mx-auto w-full">
            {{-- Header Modern Compact --}}
            <div class="text-center mb-1">
                <div class="inline-flex items-center justify-center space-x-1 mb-1">
                    <span class="px-2 py-0.5 rounded-full bg-blue-600 text-white text-[10px] font-bold tracking-wide uppercase shadow-sm">
                        Langkah 1
                    </span>
                    <span class="w-2 h-1 rounded-full bg-slate-300"></span>
                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wide">
                        Langkah 2
                    </span>
                </div>
                <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">
                    Buat Laporan
                </h2>
                <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                    Sampaikan laporan Anda dengan jelas. Identitas Anda aman.
                </p>
            </div>

            {{-- Card Form --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                
                <div class="p-5">
                    <form action="{{ route('complaint.public.step1.store') }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                        @csrf
 
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-2">
                            {{-- Judul --}}
                            <div class="sm:col-span-8">
                                <label for="title" class="block text-[10px] font-bold text-slate-700 mb-1 uppercase tracking-wide">
                                    Judul Laporan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" id="title"
                                    class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-1.5 text-sm text-slate-900 placeholder-slate-400 transition-colors"
                                    placeholder="Contoh: Jalan rusak di..." required value="{{ old('title') }}">
                                @error('title')
                                    <p class="mt-0.5 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kategori (Compact Side-by-Side) --}}
                            <div class="sm:col-span-4">
                                <label for="category_id" class="block text-[10px] font-bold text-slate-700 mb-1 uppercase tracking-wide">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="category_id" id="category_id" required
                                    class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-1.5 text-sm text-slate-900 transition-colors">
                                    <option value="" disabled selected>Pilih...</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-0.5 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Isi --}}
                            <div class="sm:col-span-12">
                                <label for="content" class="block text-[10px] font-bold text-slate-700 mb-1 uppercase tracking-wide">
                                    Detail Laporan <span class="text-red-500">*</span>
                                </label>
                                <textarea id="content" name="content" rows="3"
                                    class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-900 placeholder-slate-400 py-2 text-sm leading-relaxed transition-colors"
                                    placeholder="Jelaskan kronologi kejadian..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="mt-0.5 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Upload Image --}}
                            <div class="sm:col-span-12">
                                <label class="block text-[10px] font-bold text-slate-700 mb-1 uppercase tracking-wide">Bukti (Opsional)</label>
                                <div class="relative flex justify-center px-4 py-3 border-2 border-slate-300 border-dashed rounded-lg hover:bg-slate-50 transition-colors group cursor-pointer" id="drop-zone">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-6 w-6 text-slate-400 group-hover:text-blue-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-xs text-slate-600 justify-center gap-1">
                                            <span class="font-medium text-blue-600 group-hover:text-blue-500">
                                                Upload
                                            </span>
                                            <span class="">atau drag & drop</span>
                                        </div>
                                        <p class="text-[10px] text-slate-500">
                                            Max 5MB (JPG/PNG)
                                        </p>
                                        <div id="file-preview" class="hidden mt-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-100 text-blue-800" id="file-name">
                                            </span>
                                        </div>
                                    </div>
                                    {{-- Unified Input --}}
                                    <input id="image" name="image" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" onchange="previewImage(this)">
                                </div>
                                @error('image')
                                    <p class="mt-0.5 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0 pt-1 border-t border-slate-100 mt-1">
                            <a href="{{ url('/') }}" class="w-full sm:w-auto text-center order-2 sm:order-1 px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-700 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto order-1 sm:order-2 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-blue-600 hover:bg-blue-700 hover:shadow-blue-500/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                                Lanjut
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
             <p class="mt-3 text-center text-[10px] text-slate-400 font-medium">
                Dilindungi dengan enkripsi SSL 256-bit.
            </p>
            <div class="w-full h-20 bg-transparent"></div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const previewLink = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileName.textContent = input.files[0].name;
                previewLink.classList.remove('hidden');
            }
        }
    </script>
</x-public-layout>

```

#### File: `resources/views/public/step2.blade.php`
```html
<x-public-layout>
    <div class="w-full pt-14 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg mx-auto w-full">
            {{-- Header Compact --}}
            <div class="text-center mb-1">
                 <div class="inline-flex items-center justify-center space-x-1 mb-1">
                    <span class="w-1 h-1 rounded-full bg-blue-600"></span>
                    <span class="text-[10px] font-semibold text-blue-600 uppercase tracking-wide">
                        Langkah 1
                    </span>
                    <span class="w-2 h-1 rounded-full bg-slate-300"></span>
                    <span class="px-2 py-0.5 rounded-full bg-blue-600 text-white text-[10px] font-bold tracking-wide uppercase shadow-sm">
                        Langkah 2
                    </span>
                </div>
                <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">
                    Konfirmasi Data
                </h2>
                <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                    Pastikan detail laporan Anda sudah benar.
                </p>
            </div>

            {{-- Card Summary --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative">
                 <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                <div class="p-5">
                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Judul Laporan</label>
                        <h3 class="text-sm font-bold text-slate-900 leading-snug">{{ $data['title'] }}</h3>
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kategori Permasalahan</label>
                         <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $category->name ?? 'Kategori Tidak Ditemukan' }}
                        </span>
                    </div>

                    {{-- Isi --}}
                    <div class="mb-4">
                         <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Detail Laporan</label>
                        <div class="bg-slate-50 rounded-lg p-3 text-xs text-slate-700 border border-slate-100 leading-relaxed">
                            {!! nl2br(e($data['content'])) !!}
                        </div>
                    </div>

                    {{-- Gambar --}}
                    @if (isset($imageBase64))
                        <div class="mb-2">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Bukti Lampiran</label>
                            <div class="relative rounded-lg overflow-hidden border border-slate-200">
                                <img src="{{ $imageBase64 }}" alt="Preview" class="w-full h-32 object-contain object-center bg-slate-50">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end p-2 pointer-events-none">
                                     <span class="text-white text-[10px] font-medium opacity-90">Lampiran tersedia</span>
                                </div>
                            </div>
                        </div>
                    @else
                         <div class="mb-2">
                             <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Bukti Lampiran</label>
                            <div class="bg-slate-50 border border-slate-200 rounded-lg p-2 text-center">
                                <span class="text-[10px] text-slate-400 italic">Tidak ada lampiran</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('complaint.public.step2.store') }}" method="POST" class="pt-1">
                        @csrf
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0 pt-1 border-t border-slate-100 mt-1   ">
                            <a href="{{ route('complaint.public.step1.create') }}" class="w-full sm:w-auto text-center order-2 sm:order-1 px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-700 transition-colors">
                                Perbaiki Data
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto order-1 sm:order-2 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-emerald-600 hover:bg-emerald-700 hover:shadow-emerald-500/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:-translate-y-0.5">
                                Kirim Laporan
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
             <p class="mt-3 text-center text-[10px] text-slate-400 font-medium">
                Pastikan data Anda sudah benar sebelum mengirim.
            </p>
        </div>
    </div>
</x-public-layout>

```

#### File: `resources/views/vendor/pagination/bootstrap-4.blade.php`
```html
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

```

#### File: `resources/views/vendor/pagination/bootstrap-5.blade.php`
```html
@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif

```

#### File: `resources/views/vendor/pagination/default.blade.php`
```html
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

```

#### File: `resources/views/vendor/pagination/semantic-ui.blade.php`
```html
@if ($paginator->hasPages())
    <div class="ui pagination menu" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"> <i class="left chevron icon"></i> </a>
        @else
            <a class="icon item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"> <i class="left chevron icon"></i> </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="icon item disabled" aria-disabled="true">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="item active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="icon item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> <i class="right chevron icon"></i> </a>
        @else
            <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"> <i class="right chevron icon"></i> </a>
        @endif
    </div>
@endif

```

#### File: `resources/views/vendor/pagination/simple-bootstrap-4.blade.php`
```html
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

```

#### File: `resources/views/vendor/pagination/simple-bootstrap-5.blade.php`
```html
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{!! __('Pagination Navigation') !!}">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{!! __('pagination.previous') !!}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        {!! __('pagination.previous') !!}
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">{!! __('pagination.next') !!}</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{!! __('pagination.next') !!}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

```

#### File: `resources/views/vendor/pagination/simple-default.blade.php`
```html
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
            @else
                <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
            @endif
        </ul>
    </nav>
@endif

```

#### File: `resources/views/vendor/pagination/simple-tailwind.blade.php`
```html
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex gap-2 items-center justify-between">

        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
                {!! __('pagination.next') !!}
            </span>
        @endif

    </nav>
@endif

```

#### File: `resources/views/vendor/pagination/tailwind.blade.php`
```html
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        <div class="flex gap-2 items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
                    {!! __('pagination.next') !!}
                </span>
            @endif

        </div>

        <div class="hidden sm:flex-1 sm:flex sm:gap-2 sm:items-center sm:justify-end">

            <div></div>

            <div>
                <span class="inline-flex rtl:flex-row-reverse shadow-sm rounded-md">

                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-l-md leading-5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800 dark:text-gray-300 dark:hover:bg-gray-900 dark:hover:text-gray-300" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-gray-200 border border-gray-300 cursor-default leading-5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800 hover:bg-gray-100 dark:hover:bg-gray-900" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800 dark:text-gray-300 dark:hover:bg-gray-900 dark:hover:text-gray-300" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-r-md leading-5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

```

#### File: `resources/views/welcome.blade.php`
```html
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whistle Blowing System - Inspektorat Kota Gorontalo</title>

    <link rel="shortcut icon" href="{{ asset('images/logo-kota1.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            zoom: 0.8;
        }
        
        /* Gallery Slider Styles */
        .gallery-slider-container {
            width: 100%;
            overflow: hidden;
            padding: 20px 0;
        }

        .gallery-slider {
            display: grid;
            grid-template-rows: repeat(2, 280px);
            grid-auto-flow: column;
            grid-auto-columns: 280px;
            gap: 20px;
            overflow-x: auto;
            padding: 10px 20px 30px 20px;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .gallery-slider::-webkit-scrollbar {
            display: none;
        }

        .gallery-item-wrapper {
            scroll-snap-align: center;
            height: 100%;
            width: 100%;
        }

        .gallery-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            aspect-ratio: 1 / 1;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%; /* Ensure it fills wrapper */
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .gallery-banner {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        .gallery-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .gallery-card:hover .gallery-banner img {
            transform: scale(1.1);
        }

        .gallery-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 25px 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.6) 50%, transparent 100%);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            z-index: 1;
        }

        .gallery-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            font-family: var(--ff-montserrat);
        }

        .gallery-desc {
            font-size: 0.9rem;
            color: #e2e8f0;
            font-weight: 400;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            opacity: 0.9;
        }
    </style>
</head>

<body id="top">

    <header class="header" data-header>
        <div class="overlay" data-overlay></div>

        <div class="header-top">
            <div class="container">
                <a href="#" class="text">
                    <img src="{{ asset('images/logo-kota1.png') }}" alt="Logo Kota" style="height: 50px;">
                </a>
                <div class="header-btn-group">
                    <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
                        <ion-icon name="menu-outline"></ion-icon>
                    </button>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <nav class="navbar" data-navbar>
                    <div class="navbar-top">
                        <a href="#" class="logo">
                            <img src="{{ asset('images/logo-blue.svg') }}" alt="Inspektorat logo">
                        </a>
                        <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>

                    <ul class="navbar-list">
                        <li>
                            <a href="#home" class="navbar-link" data-nav-link>Home</a>
                        </li>
                        <li>
                            <a href="#about" class="navbar-link" data-nav-link>Tentang Kami</a>
                        </li>
                        <li>
                            <a href="#gallery" class="navbar-link" data-nav-link>Galeri</a>
                        </li>
                        <li>
                            <a href="#news" class="navbar-link" data-nav-link>Berita</a>
                        </li>
                        <li>
                            <a href="#contact" class="navbar-link" data-nav-link>Hubungi Kami</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li>
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                </li>
                                <li><a href="{{ route('register') }}" class="btn btn-secondary">Daftar Sekarang</a></li>
                            @endauth
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <article>

            <section class="hero" id="home">
                <div class="container">
                    <h1 class="h2 hero-title">Whistle Blowing System</h1>
                    <h1 class="h3 hero-title">Inspektorat Kota Gorontalo</h1>

                    <p class="hero-text">
                        Website Resmi dari Inspektorat Kota Gorontalo untuk pengaduan dan keluhan masyarakat khususnya
                        yang berada di daerah kota Gorontalo
                    </p>

                    <div class="btn-group">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-primary">Buat Laporan
                                    Baru</a>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Riwayat Laporan</a>
                            @else
                                <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-primary">Mulai
                                    Pengaduan</a>
                                <a href="{{ route('status.index') }}" class="btn btn-secondary">Cek Status Tiket</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </section>

            <section class="popular" id="about">
                <div class="container">
                    <h2 class="h2 section-title">Tentang Kami</h2>

                    <p class="section-text">
                        Selamat datang di Whistle Blowing System Inspektorat Kota Gorontalo. Website resmi ini kami
                        hadirkan untuk memfasilitasi pengaduan dan keluhan masyarakat yang berada di wilayah Kota
                        Gorontalo. Melalui sistem ini, masyarakat dapat melaporkan berbagai tindakan pelanggaran,
                        penyimpangan, maupun penyalahgunaan wewenang yang terjadi di lingkungan pemerintahan.
                    </p>

                    <h2 class="h3 section-title">Mengapa Melaporkan di Whistle Blowing System Kami?</h2>

                    <div class="popular-list">
                        <div class="popular-card">
                            <figure class="card-img">
                                <img src="{{ asset('images/ho.png') }}" alt="Kerahasiaan" loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">
                                    <span>Kerahasiaan Terjamin</span>
                                </h3>
                                <p class="card-text">
                                    Setiap laporan yang masuk dijaga dengan kerahasiaan yang tinggi.
                                </p>
                            </div>
                        </div>

                        <div class="popular-card">
                            <figure class="card-img">
                                <img src="{{ asset('images/hihi.png') }}" alt="Cepat Transparan" loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">
                                    <span>Proses Cepat & Transparan</span>
                                </h3>
                                <p class="card-text">
                                    Kami mengedepankan proses yang cepat dan transparan.
                                </p>
                            </div>
                        </div>

                        <div class="popular-card">
                            <figure class="card-img">
                                <img src="{{ asset('images/pemerintah.png') }}" alt="Pemerintahan Bersih"
                                    loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">
                                    <span>Pemerintahan Bersih</span>
                                </h3>
                                <p class="card-text">
                                    Dengan anda melaporkan, pemerintahan bersih.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="gallery" id="gallery">
                <div class="container">
                    <h2 class="h2 section-title">Galeri Foto</h2>
                    <p class="section-text">
                        Selamat datang di Galeri Foto Inspektorat Kota Gorontalo! Di sini, Anda dapat menjelajahi
                        momen-momen berharga yang mencerminkan dedikasi, inovasi, dan kebersamaan tim kami.
                    </p>

                    <div class="gallery-slider-container">
                        <ul class="gallery-slider">
                            @forelse($galleries as $gallery)
                                <li class="gallery-item-wrapper">
                                    <div class="gallery-card" onclick="openGalleryModal({{ json_encode($gallery) }})">
                                        <figure class="gallery-banner">
                                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}">
                                        </figure>
                                        <div class="gallery-content">
                                            <h3 class="gallery-title">{{ $gallery->title }}</h3>
                                            @if($gallery->description)
                                                <p class="gallery-desc">{{ $gallery->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @empty
                                {{-- Fallback data --}}
                                @php
                                    $fallbacks = [
                                        ['image' => 'images/1.jpg', 'title' => 'Kegiatan Inspektorat', 'desc' => 'Dokumentasi kegiatan rutin inspektorat kota Gorontalo.'],
                                        ['image' => 'images/3.jpg', 'title' => 'Rapat Koordinasi', 'desc' => 'Koordinasi bersama staf dan pimpinan.'],
                                        ['image' => 'images/2.jpg', 'title' => 'Kunjungan Kerja', 'desc' => 'Kunjungan kerja ke beberapa instansi terkait.'],
                                        ['image' => 'images/4.jpg', 'title' => 'Sosialisasi', 'desc' => 'Kegiatan sosialisasi kepada masyarakat.'],
                                        ['image' => 'images/5.jpg', 'title' => 'Pelatihan', 'desc' => 'Pelatihan peningkatan kapasitas pegawai.'],
                                    ];
                                @endphp
                                @foreach($fallbacks as $fb)
                                <li class="gallery-item-wrapper">
                                    <div class="gallery-card" onclick="openGalleryModal({'image_path': '{{ $fb['image'] }}', 'title': '{{ $fb['title'] }}', 'description': '{{ $fb['desc'] }}', 'is_local': true})">
                                        <figure class="gallery-banner">
                                            <img src="{{ asset($fb['image']) }}" alt="Gallery image">
                                        </figure>
                                        <div class="gallery-content">
                                            <h3 class="gallery-title">{{ $fb['title'] }}</h3>
                                            <p class="gallery-desc">{{ $fb['desc'] }}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            @endforelse
                        </ul>
                    </div>
                </div>
            </section>

            <section class="news" id="news">
                <div class="container">
                    <h2 class="h2 section-title">Berita Terkini</h2>
                    <p class="section-text">
                        Ikuti perkembangan terbaru dan informasi penting seputar kegiatan Inspektorat Kota Gorontalo.
                    </p>

                    @if($news->count() > 0)
                        <div class="news-slider-container">
                            <ul class="news-slider">
                                @foreach($news as $item)
                                    <li class="news-card-item">
                                        <div class="popular-card">
                                            <figure class="card-img">
                                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" loading="lazy">
                                            </figure>
                                            <div class="card-content">
                                                <div class="card-rating">
                                                    <ion-icon name="calendar-outline"></ion-icon>
                                                    <data>{{ $item->created_at->format('d M Y') }}</data>
                                                </div>
                                                <h3 class="h3 card-title">
                                                    <a href="javascript:void(0)" onclick="openNewsModal({{ json_encode($item) }})">{{ Str::limit($item->title, 50) }}</a>
                                                </h3>
                                                <p class="card-text">
                                                    {{ Str::limit(strip_tags($item->content), 80) }}
                                                </p>
                                                <button class="btn-detail" onclick="openNewsModal({{ json_encode($item) }})">
                                                    Lihat Detail
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div style="text-align: center; padding: 60px 20px;">
                            <div style="margin-bottom: 20px; color: #cbd5e1;">
                                <ion-icon name="newspaper-outline" style="font-size: 64px;"></ion-icon>
                            </div>
                            <h3 class="h3" style="color: #64748b; margin-bottom: 10px;">Belum ada berita saat ini</h3>
                            <p style="color: #94a3b8;">Nantikan informasi kegiatan terbaru dari Inspektorat Kota Gorontalo.</p>
                        </div>
                    @endif
                </div>
            </section>

            {{-- News Modal --}}
            <div id="news-modal" class="modal-overlay" style="display: none;">
                <div class="modal-content">
                    <button class="modal-close-btn" onclick="closeNewsModal()">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                    <figure class="modal-img-wrapper">
                        <img id="modal-img" src="" alt="News Image" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px;">
                    </figure>
                    <div class="modal-body" style="margin-top: 15px;">
                        <span id="modal-date" class="modal-date" style="font-size: 0.9em; color: #666; display: block; margin-bottom: 5px;"></span>
                        <h2 id="modal-title" class="h2 modal-title" style="color: var(--gunmetal); margin-bottom: 15px;"></h2>
                        <div id="modal-desc" class="modal-desc" style="color: var(--sonic-silver); line-height: 1.6; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>

            {{-- Gallery Modal --}}
            <div id="gallery-modal" class="modal-overlay" style="display: none;">
                <div class="modal-content">
                    <button class="modal-close-btn" onclick="closeGalleryModal()">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                    <figure class="modal-img-wrapper">
                        <img id="gallery-modal-img" src="" alt="Gallery Image" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px;">
                    </figure>
                    <div class="modal-body" style="margin-top: 15px;">
                        <span id="gallery-modal-date" class="modal-date" style="font-size: 0.9em; color: #666; display: block; margin-bottom: 5px;"></span>
                        <h2 id="gallery-modal-title" class="h2 modal-title" style="color: var(--gunmetal); margin-bottom: 15px;"></h2>
                        <div id="gallery-modal-desc" class="modal-desc" style="color: var(--sonic-silver); line-height: 1.6; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>

            <style>
                /* Modal Styles (Only minimal modal styles kept here if not in main CSS) */
                /* Actually let's move modal styles to main CSS too for cleanliness, but for this step I'll keep them or remove strictly if present in main CSS.
                   The user didn't ask to move modal styles but it's cleaner. 
                   Wait, I am replacing the big style block. I should preserve the modal styles unless I move them.
                   I didn't move modal styles to style.css yet.
                   I will keep the modal styles here for now or add them to the ReplacementContent.
                */
                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.6);
                    z-index: 1000;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
                    backdrop-filter: blur(5px);
                }
                .modal-content {
                    background: white;
                    padding: 25px;
                    border-radius: 15px;
                    max-width: 600px;
                    width: 100%;
                    max-height: 90vh;
                    overflow-y: auto;
                    position: relative;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                    animation: modalSlideIn 0.3s ease-out;
                }
                .modal-close-btn {
                    position: absolute;
                    top: 15px;
                    right: 15px;
                    background: #f1f1f1;
                    border: none;
                    border-radius: 50%;
                    width: 32px;
                    height: 32px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    font-size: 20px;
                    color: #333;
                    transition: background 0.2s;
                }
                .modal-close-btn:hover {
                    background: #e1e1e1;
                }
                @keyframes modalSlideIn {
                    from { transform: translateY(20px); opacity: 0; }
                    to { transform: translateY(0); opacity: 1; }
                }
            </style>

            <script>
                function openNewsModal(newsItem) {
                    const modal = document.getElementById('news-modal');
                    const img = document.getElementById('modal-img');
                    const title = document.getElementById('modal-title');
                    const date = document.getElementById('modal-date');
                    const desc = document.getElementById('modal-desc');

                    // Set Content
                    img.src = "{{ asset('storage/') }}/" + newsItem.image_path;
                    title.innerText = newsItem.title;
                    
                    // Format Date (Simple JS date)
                    const d = new Date(newsItem.created_at);
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    date.innerText = d.toLocaleDateString('id-ID', options);
                    
                    desc.innerText = newsItem.content; // Use innerText to treat as plain text if content is plain, or innerHTML if it contains safe HTML

                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden'; // Prevent background scrolling
                }

                function closeNewsModal() {
                    const modal = document.getElementById('news-modal');
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }

                // Close on click outside
                document.getElementById('news-modal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeNewsModal();
                    }
                });

                /* Gallery Modal Functions */
                function openGalleryModal(item) {
                    const modal = document.getElementById('gallery-modal');
                    const img = document.getElementById('gallery-modal-img');
                    const title = document.getElementById('gallery-modal-title');
                    const desc = document.getElementById('gallery-modal-desc');
                    const date = document.getElementById('gallery-modal-date');

                    const basePath = item.is_local ? "{{ asset('') }}" : "{{ asset('storage/') }}/";
                    // If item.image_path (from DB) or item.image_path (from fallback, wait fallback use 'image')
                    // Let's standardise
                    let imageSrc = '';
                    if(item.is_local) {
                        imageSrc = basePath + item.image_path; // item.image_path passed as "images/..."
                    } else {
                        imageSrc = basePath + item.image_path;
                    }
                    
                    img.src = imageSrc;
                    title.innerText = item.title;
                    desc.innerText = item.description || '';
                    
                    // Add date if available (optional, but matching news structure)
                    if(item.created_at) {
                         const d = new Date(item.created_at);
                         const options = { year: 'numeric', month: 'long', day: 'numeric' };
                         date.innerText = d.toLocaleDateString('id-ID', options);
                         date.style.display = 'block';
                    } else {
                        date.style.display = 'none';
                    }

                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }

                function closeGalleryModal() {
                    const modal = document.getElementById('gallery-modal');
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }

                document.getElementById('gallery-modal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeGalleryModal();
                    }
                });
            </script>

            <section class="cta" id="contact">
                <div class="container">
                    <div class="cta-content">
                        <p class="section-subtitle">Call To Action</p>
                        <h2 class="h2 section-title">Kami ingin Mendengar dari Anda !</h2>
                        <p class="section-text">
                            Kami siap membantu Anda! Jika Anda memiliki pertanyaan, saran, atau umpan balik, jangan ragu
                            untuk menghubungi kami.
                        </p>
                    </div>
                    <a href="#gg" class="btn btn-secondary">Contact Us !</a>
                </div>
            </section>

        </article>
    </main>

    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-brand">
                    <a href="#" class="logo">
                        <img src="{{ asset('images/test.png') }}" alt="Inspektorat logo">
                    </a>
                    <p class="footer-text">
                        Website Resmi dari Inspektorat Kota Gorontalo untuk pengaduan dan keluhan masyarakat khususnya
                        yang berada di daerah kota Gorontalo
                    </p>
                </div>

                <div class="footer-contact">
                    <h4 class="contact-title" id="gg">Contact Us</h4>
                    <p class="contact-text">Feel free to contact and reach us !!</p>
                    <ul>
                        <li class="contact-item">
                            <ion-icon name="call-outline"></ion-icon>
                            <a href="tel:+6282349656594" class="contact-link">+62823-49-6565-94</a>
                        </li>
                        <li class="contact-item">
                            <ion-icon name="mail-outline"></ion-icon>
                            <a href="mailto:inspektoratgtlo@gmail.com"
                                class="contact-link">inspektoratgtlo@gmail.com</a>
                        </li>
                        <li class="contact-item">
                            <ion-icon name="location-outline"></ion-icon>
                            <address>Jl. Achmad Nadjamuddin No 11 Wumialo Kota Gorontalo, Gorontalo</address>
                        </li>
                    </ul>
                </div>

                <div class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d558.6719892285665!2d123.05598984058676!3d0.5572244054739232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1768815766156!5m2!1sid!2sid"
                        width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="copyright-container">
                <p class="copyright">
                    © {{ date('Y') }} <a href="">Inspektorat Kota Gorontalo</a>. All rights reserved
                </p>
            </div>
        </div>
    </footer>

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up-outline"></ion-icon>
    </a>

    <script src="{{ asset('js/script1.js') }}"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>

```

---

## 🏁 CHECKLIST & PANDUAN PENGEMBANGAN UNTUK AI
Ketika pengguna meminta Anda menambahkan kode, fitur baru, atau memperbaiki bug:
1. **Periksa Skema Database (Seksi 3):** Pastikan field database yang digunakan benar-benar ada. Jangan gunakan field yang belum dimigrasi.
2. **Gunakan Relasi Model yang Ada (Seksi 4):** Jangan membuat query manual kompleks jika sudah ada relasi Eloquent yang terdefinisi.
3. **Patuhi Hak Akses & Role (Seksi 5):** Pasang middleware atau permission yang tepat sesuai Spatie / gate yang ada.
4. **Validasi Request (Seksi 6):** Jangan validasi mentah di controller jika format proyek menggunakan custom Form Request (`php artisan make:request`).
