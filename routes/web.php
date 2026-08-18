<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/pengaduan', [DashboardController::class, 'pengaduan'])->name('dashboard.pengaduan');
Route::get('/dashboard/pengaduan/tambah', [DashboardController::class, 'tambahPengaduan'])->name('dashboard.pengaduan.tambah');
Route::post('/dashboard/pengaduan/simpan', [DashboardController::class, 'simpanPengaduan'])->name('dashboard.pengaduan.simpan');
Route::get('/dashboard/pengaduan/{id}', [DashboardController::class, 'detailPengaduan'])->name('dashboard.pengaduan.detail');
Route::get('/dashboard/petugas/pengaduan/{id}', [DashboardController::class, 'detailPengaduanPetugas'])->name('petugas.pengaduan.detail');
Route::post('/dashboard/petugas/pengaduan/{id}/tanggapan', [DashboardController::class, 'simpanTanggapanPetugas'])->name('petugas.pengaduan.tanggapan');

