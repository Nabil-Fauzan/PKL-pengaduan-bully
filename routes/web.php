<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    if (Auth::guard('siswa')->check()) {
        $siswa = Auth::guard('siswa')->user();
        return "
            <div style='font-family: sans-serif; padding: 40px; max-width: 600px; margin: 40px auto; border: 1px solid #e2e8f0; border-radius: 8px;'>
                <h1 style='color: #4f46e5; margin-top: 0;'>Dashboard Siswa</h1>
                <p>Selamat datang, <b>" . htmlspecialchars($siswa->nama) . "</b> (NIS: " . htmlspecialchars($siswa->nis) . ").</p>
                <p>Kelas: " . htmlspecialchars($siswa->kelas) . " - " . htmlspecialchars($siswa->jurusan) . "</p>
                <hr style='border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;'>
                <form action='" . route('logout') . "' method='POST'>
                    " . csrf_field() . "
                    <button type='submit' style='background-color: #ef4444; color: white; border: 0; padding: 10px 20px; border-radius: 6px; cursor: pointer;'>Logout</button>
                </form>
            </div>
        ";
    }

    if (Auth::guard('web')->check()) {
        $user = Auth::guard('web')->user();
        return "
            <div style='font-family: sans-serif; padding: 40px; max-width: 600px; margin: 40px auto; border: 1px solid #e2e8f0; border-radius: 8px;'>
                <h1 style='color: #4f46e5; margin-top: 0;'>Dashboard Petugas (" . ucfirst(htmlspecialchars($user->role)) . ")</h1>
                <p>Selamat datang, <b>" . htmlspecialchars($user->nama) . "</b> (Username: " . htmlspecialchars($user->username) . ").</p>
                <p>Email: " . htmlspecialchars($user->email) . "</p>
                <hr style='border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;'>
                <form action='" . route('logout') . "' method='POST'>
                    " . csrf_field() . "
                    <button type='submit' style='background-color: #ef4444; color: white; border: 0; padding: 10px 20px; border-radius: 6px; cursor: pointer;'>Logout</button>
                </form>
            </div>
        ";
    }

    return redirect('/login')->withErrors(['login_identifier' => 'Silakan login terlebih dahulu.']);
})->name('dashboard');
