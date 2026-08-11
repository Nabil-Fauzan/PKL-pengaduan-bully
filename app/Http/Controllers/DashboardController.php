<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard yang sesuai berdasarkan guard user.
     */
    public function index()
    {
        if (Auth::guard('siswa')->check()) {
            $siswa = Auth::guard('siswa')->user();
            return view('siswa.dashboard', compact('siswa'));
        }

        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            return view('petugas.dashboard', compact('user'));
        }

        return redirect('/login')->withErrors(['login_identifier' => 'Silakan masuk terlebih dahulu.']);
    }

    /**
     * Tampilkan halaman pengaduan berdasarkan guard user.
     */
    public function pengaduan()
    {
        if (Auth::guard('siswa')->check()) {
            return view('siswa.pengaduan');
        }

        if (Auth::guard('web')->check()) {
            return view('petugas.pengaduan');
        }

        return redirect('/login')->withErrors(['login_identifier' => 'Silakan masuk terlebih dahulu.']);
    }
}
