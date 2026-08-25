<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/pengaduan', [DashboardController::class, 'pengaduan'])->name('dashboard.pengaduan');
Route::get('/dashboard/pengaduan/tambah', [DashboardController::class, 'tambahPengaduan'])->name('dashboard.pengaduan.tambah');
Route::post('/dashboard/pengaduan/simpan', [DashboardController::class, 'simpanPengaduan'])->name('dashboard.pengaduan.simpan');
Route::get('/dashboard/pengaduan/{id}', [DashboardController::class, 'detailPengaduan'])->name('dashboard.pengaduan.detail');
Route::get('/dashboard/petugas/pengaduan/{id}', [DashboardController::class, 'detailPengaduanPetugas'])->name('petugas.pengaduan.detail');
Route::post('/dashboard/petugas/pengaduan/{id}/tanggapan', [DashboardController::class, 'simpanTanggapanPetugas'])->name('petugas.pengaduan.tanggapan');

// Admin Account Management Routes
Route::get('/dashboard/admin/siswa', [AdminController::class, 'siswaIndex'])->name('admin.siswa');
Route::get('/dashboard/admin/siswa/tambah', [AdminController::class, 'siswaCreate'])->name('admin.siswa.tambah');
Route::post('/dashboard/admin/siswa/simpan', [AdminController::class, 'siswaStore'])->name('admin.siswa.simpan');
Route::get('/dashboard/admin/siswa/edit/{id}', [AdminController::class, 'siswaEdit'])->name('admin.siswa.edit');
Route::post('/dashboard/admin/siswa/update/{id}', [AdminController::class, 'siswaUpdate'])->name('admin.siswa.update');
Route::post('/dashboard/admin/siswa/toggle/{id}', [AdminController::class, 'siswaToggleStatus'])->name('admin.siswa.toggle');

Route::get('/dashboard/admin/petugas', [AdminController::class, 'petugasIndex'])->name('admin.petugas');
Route::get('/dashboard/admin/petugas/tambah', [AdminController::class, 'petugasCreate'])->name('admin.petugas.tambah');
Route::post('/dashboard/admin/petugas/simpan', [AdminController::class, 'petugasStore'])->name('admin.petugas.simpan');
Route::get('/dashboard/admin/petugas/edit/{id}', [AdminController::class, 'petugasEdit'])->name('admin.petugas.edit');
Route::post('/dashboard/admin/petugas/update/{id}', [AdminController::class, 'petugasUpdate'])->name('admin.petugas.update');
Route::post('/dashboard/admin/petugas/toggle/{id}', [AdminController::class, 'petugasToggleStatus'])->name('admin.petugas.toggle');

Route::get('/dashboard/admin/setting', [AdminController::class, 'settingsIndex'])->name('admin.setting');
Route::post('/dashboard/admin/setting', [AdminController::class, 'settingsUpdate'])->name('admin.setting.update');

