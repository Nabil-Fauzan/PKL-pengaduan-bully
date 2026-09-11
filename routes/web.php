<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes - STIPOR (Sistem Pengaduan Bullying SMK TI Airlangga)
|--------------------------------------------------------------------------
| File ini mendefinisikan seluruh rute web aplikasi yang terbagi menjadi:
| 1. Halaman Publik (Landing Page)
| 2. Autentikasi (Login & Logout)
| 3. Portal Dashboard & Pengaduan (Siswa & Petugas BK)
| 4. Manajemen Akun & Pengaturan Sistem (Administrator)
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. HALAMAN PUBLIK
// =========================================================================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// =========================================================================
// 2. AUTENTIKASI (LOGIN & LOGOUT)
// =========================================================================
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->middleware('throttle:5,1');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/logout', function () {
        return redirect('/');
    });
});

// =========================================================================
// 3. DASHBOARD & PENGADUAN (SISWA & PETUGAS BK)
// =========================================================================
Route::prefix('dashboard')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        // Beranda Dashboard (Multi-Guard View)
        Route::get('/', 'index')->name('dashboard');

        // Pengaduan Siswa
        Route::get('/pengaduan', 'pengaduan')->name('dashboard.pengaduan');
        Route::get('/pengaduan/tambah', 'tambahPengaduan')->name('dashboard.pengaduan.tambah');
        Route::post('/pengaduan/simpan', 'simpanPengaduan')->name('dashboard.pengaduan.simpan');
        Route::get('/pengaduan/{id}', 'detailPengaduan')->name('dashboard.pengaduan.detail')->whereNumber('id');

        // Investigasi & Tanggapan Petugas BK
        Route::get('/petugas/pengaduan/{id}', 'detailPengaduanPetugas')->name('petugas.pengaduan.detail')->whereNumber('id');
        Route::post('/petugas/pengaduan/{id}/tanggapan', 'simpanTanggapanPetugas')->name('petugas.pengaduan.tanggapan')->whereNumber('id');
    });

    // =====================================================================
    // 4. MANAJEMEN ADMINISTRATOR
    // =====================================================================
    Route::prefix('admin')->controller(AdminController::class)->group(function () {

        // Manajemen Akun Siswa
        Route::prefix('siswa')->group(function () {
            Route::get('/', 'siswaIndex')->name('admin.siswa');
            Route::get('/tambah', 'siswaCreate')->name('admin.siswa.tambah');
            Route::post('/simpan', 'siswaStore')->name('admin.siswa.simpan');
            Route::get('/edit/{id}', 'siswaEdit')->name('admin.siswa.edit')->whereNumber('id');
            Route::post('/update/{id}', 'siswaUpdate')->name('admin.siswa.update')->whereNumber('id');
            Route::post('/toggle/{id}', 'siswaToggleStatus')->name('admin.siswa.toggle')->whereNumber('id');
        });

        // Manajemen Akun Petugas & Admin
        Route::prefix('petugas')->group(function () {
            Route::get('/', 'petugasIndex')->name('admin.petugas');
            Route::get('/tambah', 'petugasCreate')->name('admin.petugas.tambah');
            Route::post('/simpan', 'petugasStore')->name('admin.petugas.simpan');
            Route::get('/edit/{id}', 'petugasEdit')->name('admin.petugas.edit')->whereNumber('id');
            Route::post('/update/{id}', 'petugasUpdate')->name('admin.petugas.update')->whereNumber('id');
            Route::post('/toggle/{id}', 'petugasToggleStatus')->name('admin.petugas.toggle')->whereNumber('id');
        });

        // Pengaturan Pilihan Jurusan
        Route::get('/setting', 'settingsIndex')->name('admin.setting');
        Route::post('/setting', 'settingsUpdate')->name('admin.setting.update');
    });

});


