# 🛡️ Layanan Pengaduan Bullying — SMK TI Airlangga

Sistem Informasi Portal Bimbingan Konseling (BK) berbasis web untuk melaporkan tindakan perundungan (bullying), masalah fasilitas, akademik, atau hal lainnya secara aman, rahasia, dan transparan bagi murid **SMK TI Airlangga**.

---

## ✨ Fitur Unggulan Sistem

### 👨‍🎓 Portal Siswa (Front-End & Mobile-Friendly)

Antarmuka modern bernuansa *indigo solid* yang responsif untuk perangkat desktop maupun smartphone:

- **Auto-Save Draft (LocalStorage)**: Secara otomatis menyimpan draft isi pengaduan Anda saat mengetik untuk mencegah kehilangan data jika koneksi terputus.
- **Penghitung Karakter Real-time**: Pembatasan input laporan maksimal 2000 karakter dengan indikator counter dinamis.
- **Salin ID Pengaduan Instan**: Menyalin ID pengaduan unik sekali klik lengkap dengan efek konfirmasi visual.
- **Pencarian & Saringan Instan (Client-Side)**: Menyaring riwayat laporan secara real-time berdasarkan kata kunci judul, kategori, status (termasuk filter virtual *Terabaikan*), dan **Rentang Tanggal**.
- **Kategori Kustom "Lainnya"**: Input dinamis spesifikasi laporan jika memilih kategori 'lainnya', yang akan secara otomatis terekam ke format data laporan.
- **FAQ Keamanan Data & Kerahasiaan BK**: Akordion interaktif di sidebar yang meredakan kecemasan murid mengenai perlindungan kerahasiaan identitas dan estimasi waktu penanganan kasus.
- **Dukungan Dark Mode**: Pilihan mode gelap yang tersinkronisasi otomatis dengan preferensi browser dan tersimpan di `localStorage`.

### 👮‍♂️ Portal Back-End (Admin & Petugas BK - AdminLTE)

Halaman admin dan petugas menggunakan tata letak solid flat-design khas AdminLTE:

- **Dashboard Statistik Riil**: Dilengkapi 4 kartu indikator utama (*Total, Baru, Proses, Terabaikan >3 hari*) dan **Grafik Batang Chart.js** untuk melihat penyebaran distribusi kategori pengaduan secara instan.
- **Detail Penanganan Kasus**: Garis waktu (*timeline*) riwayat tindak lanjut bimbingan konseling lengkap dengan nama petugas penangan.
- **Templat Respon BK Cepat**: Tombol tanggapan sekali klik yang otomatis mengisi pesan formal bimbingan konseling dan menyesuaikan status laporan (Diproses/Selesai/Ditolak).
- **CRUD Akun Siswa & Petugas (Khusus Admin)**: Manajemen pendaftaran akun baru, pencarian instan, paginasi, dan reset kata sandi dengan toggle intip kata sandi.
- **Pengaturan Jurusan Dinamis (Khusus Admin)**: Admin dapat menambah, mengubah, dan menghapus pilihan jurusan yang tersedia secara global di database (default: RPL/PPLG, MPLB, TKJ/TJKT, DKV).
- **Proteksi Akun Mandiri (Self-Protection)**: Perlindungan keamanan yang mencegah administrator aktif menonaktifkan atau menurunkan level perannya sendiri.

---

## 🔒 Fitur & Arsitektur Keamanan (Security Hardening)

Aplikasi ini telah melalui audit keamanan menyeluruh (*Deep Security Audit*) dan menerapkan pertahanan berlapis (*Defense-in-Depth*):

1. **Proteksi Brute-Force**: Middleware `throttle:5,1` membatasi percobaan login maksimal 5 kali per menit per alamat IP.
2. **Server-Side Google reCAPTCHA v2**: Validasi token CAPTCHA dilakukan langsung ke endpoint resmi Google API di backend.
3. **Pencegahan IDOR (Insecure Direct Object Reference)**: Kueri detail laporan di-scope ketat berdasarkan identitas siswa yang login (`where('id_siswa', $authId)`).
4. **Pencegahan Parameter Tampering**: Pembuatan pengaduan dan tanggapan selalu mengikat `id_siswa` dan `id_petugas` dari sesi server, mengabaikan manipulasi body HTTP POST.
5. **Anti-User Enumeration**: Pesan error kegagalan login bersifat generik dan seragam untuk mencegah penyerang menebak keberadaan username/NIS.
6. **Dual-Guard Isolation**: Isolasi penuh antara guard otentikasi Siswa (`guard('siswa')`) dan Petugas/Admin (`guard('web')`).
7. **HTTP Security Headers**: Dilengkapi middleware global yang menyuntikkan header pertahanan browser:
   - `X-Frame-Options: SAMEORIGIN` & `frame-ancestors 'self'` (Anti-Clickjacking)
   - `X-Content-Type-Options: nosniff` (Anti-MIME Sniffing)
   - `Referrer-Policy: strict-origin-when-cross-origin`
   - `Content-Security-Policy (CSP)` (Anti-XSS Defense)
8. **Enkripsi Kata Sandi Standar Industri**: Menggunakan salted Bcrypt hashing dengan work factor 12.

---

## 🛠️ Persyaratan Sistem

- **PHP** >= 8.2 (Mendukung PHP 8.3 & 8.5)
- **Composer** (Manajer Dependensi PHP)
- **Node.js** >= 18 & **npm** (Compiler Aset Frontend)
- **MySQL** / **MariaDB** (Database Relasional)

---

## 🚀 Panduan Instalasi & Setup Lokal

### Langkah 1: Clone Repositori

```bash
git clone <repository-url> pkl-bully
```

### Langkah 2: Instal Dependensi

```bash
composer install
npm install
```

### Langkah 3: Konfigurasi Environment (`.env`)

Salin berkas `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pengaduansekolah
DB_USERNAME=root
DB_PASSWORD=

RECAPTCHA_SITEKEY=your-recaptcha-sitekey-here
RECAPTCHA_SECRET=your-recaptcha-secretkey-here
```

### Langkah 4: Generate Application Key

```bash
php artisan key:generate
```

### Langkah 5: Migrasi & Seed Database

Jalankan perintah berikut untuk membuat tabel, relasi, dan akun demo pengujian:

```bash
php artisan migrate:fresh --seed
```

### Langkah 6: Kompilasi Aset Frontend

```bash
npm run build
```

### Langkah 7: Jalankan Server Lokal

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Aplikasi dapat diakses melalui browser: `http://localhost:8000` (atau via IP Wi-Fi laptop untuk pengujian di handphone).

---

## 🧪 Pengujian Otomatis (Automated Test Suite)

Aplikasi dilengkapi suite pengujian otomatis fitur dan keamanan:

```bash
php artisan test
```

**Cakupan Uji (24 Tests, 99 Assertions):**

- Autentikasi Siswa & Petugas (Login, Logout, Session Invalidation).
- Rate limiting, anti-brute force, dan server-side reCAPTCHA.
- Anti-IDOR & isolasi rute hak akses (Siswa vs Petugas vs Admin).
- Anti-tampering parameter pengaduan.
- Verifikasi keberadaan Security Headers pada response HTTP.

---

## 🔑 Akun Demo Pengujian

Kredensial bawaan yang dibuat oleh seeder (`DatabaseSeeder.php`):

| Peran (Role) | Kredensial Login | Kata Sandi | Hak Akses Utama |
| :--- | :--- | :--- | :--- |
| **Siswa** | NIS: `12345` | `siswa` | Mengajukan laporan, melihat status laporan pribadi, auto-save draft. |
| **Petugas BK** | Username: `user` (atau `user@gmail.com`) | `user` | Melihat seluruh antrean aduan, investigasi, dan mengirim tanggapan resmi. |
| **Administrator** | Username: `admin` (atau `admin@gmail.com`) | `admin` | CRUD Akun Siswa & Petugas, Pengaturan Pilihan Jurusan Global. |

---

## 📁 Struktur Berkas Kunci

- `app/Http/Controllers/Auth/LoginController.php`: Pengontrol alur multi-guard login, regenerasi sesi, dan rate limiting.
- `app/Http/Controllers/AdminController.php`: Pengontrol manajemen CRUD akun dan dinamisasi opsi jurusan sekolah.
- `app/Http/Controllers/DashboardController.php`: Pengontrol dashboard, filter laporan, dan formulir tanggapan BK.
- `app/Http/Middleware/SecurityHeaders.php`: Middleware injeksi HTTP Security Headers (CSP, X-Frame-Options, dll).
- `app/Models/Setting.php`: Model penanganan JSON array jurusan di tabel `setting`.
- `resources/views/welcome.blade.php`: Halaman muka publik (landing page) responsif & dark mode support.
- `resources/views/siswa/dashboard.blade.php`: Portal utama siswa pelapor lengkap dengan pencarian dan filter tanggal.
- `resources/views/petugas/dashboard.blade.php`: Beranda petugas BK lengkap dengan diagram batang Chart.js.
- `tests/Feature/SecurityAuditTest.php`: Suite pengujian keamanan otomatis untuk IDOR, RBAC, dan rate limiting.
