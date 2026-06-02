# Notes API

REST API berbasis Laravel 10 yang menyediakan layanan autentikasi JWT dan manajemen data catatan (Notes). API ini digunakan sebagai backend untuk aplikasi Flutter Notes JWT App.

## Teknologi yang Digunakan

Laravel 10

MySQL

JWT Authentication

REST API

## Fitur

Registrasi pengguna.

Login menggunakan email dan password.

Autentikasi JWT.

Logout dan invalidasi token.

Manajemen profil pengguna.

CRUD catatan.

Proteksi endpoint menggunakan middleware JWT.

## Instalasi

Clone repository terlebih dahulu.

```bash
git clone https://github.com/username/nama_repo.git
cd nama_folder
```

Install dependency Laravel.

```bash
composer install
```

Salin file environment.

```bash
cp .env.example .env
```

Generate application key.

```bash
php artisan key:generate
```

Install JWT Package.

```bash
composer require tymon/jwt-auth
```

Publish konfigurasi JWT.

```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

Generate JWT Secret.

```bash
php artisan jwt:secret
```

## Konfigurasi Database

Buat database MySQL terlebih dahulu.

```sql
CREATE DATABASE notes_db;
```

Kemudian sesuaikan konfigurasi berikut pada file `.env`.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=notes_db
DB_USERNAME=root
DB_PASSWORD=
```

## Migrasi dan Seeder

Jalankan migrasi database.

```bash
php artisan migrate
```

Isi data awal menggunakan seeder.

```bash
php artisan db:seed
```

Atau jalankan reset database sekaligus seeding.

```bash
php artisan migrate:fresh --seed
```

## Menjalankan Server

```bash
php artisan serve
```

Server akan berjalan pada alamat:

```text
http://127.0.0.1:8000
```

Untuk akses dari perangkat lain dalam jaringan yang sama:

```bash
php artisan serve --host=0.0.0.0
```

## Struktur Endpoint

### Public Endpoint

```http
POST /api/register
POST /api/login
```

### Protected Endpoint

```http
POST /api/logout
POST /api/refresh
GET  /api/me
```

### Notes Endpoint

```http
GET    /api/notes
POST   /api/notes
GET    /api/notes/{id}
PUT    /api/notes/{id}
DELETE /api/notes/{id}
```

## Contoh Login

Request:

```http
POST /api/login
Content-Type: application/json
```

```json
{
  "email": "admin@demo.com",
  "password": "password123"
}
```

Response:

```json
{
  "message": "Login berhasil",
  "token": "jwt_token",
  "user": {}
}
```

## Keamanan

Seluruh endpoint catatan hanya dapat diakses oleh pengguna yang telah terautentikasi.

Setiap request wajib menyertakan header:

```http
Authorization: Bearer <token>
```

Data catatan hanya dapat diakses oleh pemilik catatan yang bersangkutan.

## Akun Demo

```text
Email    : admin@demo.com
Password : password123
```

