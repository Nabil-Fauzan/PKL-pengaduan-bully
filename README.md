# Layanan Pengaduan Bullying - SMK TI Airlangga

Sistem informasi berbasis web untuk melaporkan tindakan perundungan (bullying), masalah fasilitas, akademik, atau hal lainnya secara aman dan rahasia.

## Fitur Utama

- **Multi-Auth**: Sistem masuk terpisah untuk Siswa (menggunakan NIS) dan Petugas/Admin (menggunakan Username/Email).
- **Google reCAPTCHA v2**: Proteksi halaman login dari brute-force/bot.
- **Pengaduan Bullying**: Formulir pengaduan dengan status real-time (`baru`, `diproses`, `selesai`, `ditolak`).
- **Tanggapan**: Memungkinkan Petugas memberikan respon langsung ke pengaduan siswa.

## Persyaratan Sistem

- PHP >= 8.2
- MySQL / MariaDB
- Composer
- Node.js & npm

## Instalasi

1. Clone repositori ini.
2. Jalankan instalasi dependensi backend dengan perintah `composer install`.
3. Jalankan instalasi dependensi frontend dengan perintah `npm install`.
4. Salin `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
5. Generate application key dengan perintah `php artisan key:generate`.
6. Jalankan migrasi dan seeder database dengan perintah `php artisan migrate:fresh --seed`.
7. Jalankan server pembangunan Laravel dengan perintah `php artisan serve`.
8. Jalankan server pembangunan Vite dengan perintah `npm run dev`.

## Akun Demo Pengujian

Setelah menjalankan seeder, akun-akun berikut tersedia untuk login:

### 1. Siswa

- **NIS**: `12345`
- **Password**: `siswa`

### 2. Administrator

- **Username**: `admin`
- **Email**: `admin@gmail.com`
- **Password**: `admin`

### 3. Petugas

- **Username**: `user`
- **Email**: `user@gmail.com`
- **Password**: `user`
