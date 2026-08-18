# 🛡️ Layanan Pengaduan Bullying — SMK TI Airlangga

Sistem Informasi Portal Bimbingan Konseling (BK) berbasis web untuk melaporkan tindakan perundungan (bullying), masalah fasilitas, akademik, atau hal lainnya secara aman, rahasia, dan transparan bagi murid **SMK TI Airlangga**.

---

## ✨ Fitur Unggulan Portal

### 👨‍🎓 Portal Siswa (Front-End)

Siswa disajikan antarmuka modern bernuansa *indigo-glassmorphism* dengan fitur penunjang kenyamanan melapor (QoL):

- **Auto-Save Draft (LocalStorage)**: Secara otomatis menyimpan draft isi pengaduan Anda saat mengetik untuk mencegah kehilangan data jika koneksi terputus.
- **Penghitung Karakter Real-time**: Pembatasan input laporan maksimal 2000 karakter dengan indikator counter dinamis.
- **Salin ID Pengaduan Instan**: Menyalin ID pengaduan unik sekali klik lengkap dengan efek centang animasi bouncy.
- **Pencarian & Saringan Instan (Client-Side)**: Menyaring riwayat laporan secara real-time berdasarkan kata kunci, kategori, status (termasuk filter virtual *Terabaikan*), dan **Rentang Tanggal**.
- **Kategori Kustom "Lainnya"**: Input dinamis spesifikasi laporan jika memilih kategori 'lainnya', yang akan secara otomatis terekam ke data laporan.
- **FAQ Keamanan Data & Kerahasiaan BK**: Akordion interaktif di sidebar yang meredakan kecemasan murid mengenai perlindungan kerahasiaan identitas dan estimasi penanganan kasus.

### 👮‍♂️ Portal Back-End (Admin & Petugas)

Halaman admin dan petugas menggunakan layout flat-design solid khas AdminLTE (bebas warna gradasi sesuai instruksi):

- **Dashboard Statistik Riil**: Dilengkapi 4 kartu indikator utama (Total, Baru, Proses, Terabaikan >3 hari) dan **Grafik Batang Chart.js** untuk melihat penyebaran distribusi kategori pengaduan secara instan.
- **Detail Penanganan Kasus**: Garis waktu (*timeline*) penanganan sebelumnya serta form tanggapan BK yang cerdas.
- **Templat Respon BK Cepat**: Tombol tanggapan sekali klik yang otomatis mengisi pesan formal bimbingan konseling dan menyesuaikan status laporan (Diproses/Selesai/Ditolak).
- **CRUD Akun Siswa & Petugas (Khusus Admin)**: Manajemen pendaftaran akun baru, reset kata sandi, dengan toggle mata tampilkan/sembunyikan sandi saat input.
- **Pengaturan Jurusan Dinamis (Khusus Admin)**: Admin dapat menambah, mengubah, dan menghapus pilihan jurusan yang tersedia secara global di database (default: RPL/PPLG, MPLB, TKJ/TJKT, DKV).
- **Proteksi Akun Mandiri**: Perlindungan keamanan yang mencegah administrator aktif menonaktifkan atau menurunkan level perannya sendiri secara tidak sengaja.

---

## 🛠️ Persyaratan Sistem

- **PHP** >= 8.2 (Mendukung PHP 8.5.x)
- **Composer** (Manajer Dependensi PHP)
- **Node.js** >= 18 & **npm** (Compiler Aset Frontend)
- **MySQL** / **MariaDB** (Database Relasional)

---

## 🚀 Panduan Instalasi & Setup

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

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pengaduansekolah
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan kredensial **Google reCAPTCHA v2** terpasang di `.env` (sudah terintegrasi otomatis):

```env
NOCAPTCHA_SITEKEY=6Lf36X4tAAAAAF_WE2WGqApSmi9N2t1ZMNrmn7Xq
NOCAPTCHA_SECRET=6Lf36X4tAAAAACZwFWLsDxq_8LnryJSU2DDkrIJQ
```

### Langkah 4: Generate Application Key

```bash
php artisan key:generate
```

### Langkah 5: Migrasi & Seed Database

Jalankan perintah berikut untuk membuat tabel, relasi, data default jurusan, serta akun demo pengujian:

```bash
php artisan migrate:fresh --seed
```

### Langkah 6: Jalankan Aplikasi secara Lokal

Buka dua terminal terpisah dan jalankan:

- Terminal 1: Server Backend

```bash
php artisan serve
```

- Terminal 2: Server Frontend Compiler (Vite)

```bash
npm run dev
```

Aplikasi dapat diakses di browser melalui alamat: `http://127.0.0.1:8000/login`

---

## 🔑 Akun Demo Pengujian

Gunakan kredensial berikut untuk menguji alur sistem bimbingan konseling:

### 1. Peran: Siswa (Portal Front-End)

- **Username / NIS**: `12345`
- **Password**: `siswa`
- **Status**: `aktif`

### 2. Peran: Administrator (Akses Manajemen & Pengaturan Penuh)

- **Username / Email**: `admin` / `admin@gmail.com`
- **Password**: `admin`
- **Akses**: CRUD Akun Siswa & Petugas, Pengaturan Pilihan Jurusan Global.

### 3. Peran: Petugas BK (Akses Investigasi & Tanggapan Laporan)

- **Username / Email**: `user` / `user@gmail.com`
- **Password**: `user`
- **Akses**: Dashboard Grafik, Detail Tanggapan Laporan, Saringan Status Terabaikan.

---

## 📁 Struktur Berkas Kunci (Pembaruan Custom)

- `app/Models/Setting.php`: Model dinamis untuk penanganan JSON array jurusan di tabel `setting`.
- `app/Http/Controllers/AdminController.php`: Pengontrol hak akses manajemen CRUD akun dan dinamisasi opsi jurusan sekolah.
- `app/Http/Controllers/DashboardController.php`: Pengontrol dashboard backend & filter statistik kategori.
- `resources/views/siswa/dashboard.blade.php`: Portal utama siswa pelapor lengkap dengan pencarian, filter tanggal, dan akordion FAQ.
- `resources/views/petugas/dashboard.blade.php`: Beranda petugas BK lengkap dengan diagram batang Chart.js.
- `resources/views/petugas/detail_pengaduan.blade.php`: Formulir tindak lanjut laporan berkas BK dan tombol templat tanggapan cepat.
- `resources/views/admin/setting.blade.php`: Antarmuka manajemen opsi jurusan sekolah.
