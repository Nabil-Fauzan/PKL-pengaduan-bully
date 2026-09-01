<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm(Request $request)
    {
        // Pastikan jika sudah login diarahkan ke dashboard
        if (Auth::guard('web')->check() || Auth::guard('siswa')->check()) {
            return redirect()->intended('/dashboard');
        }

        // Tentukan default role aktif (petugas atau siswa), periksa input lama jika redirect back
        $role = old('role', $request->query('role', 'siswa'));
        if (!in_array($role, ['siswa', 'petugas'])) {
            $role = 'siswa';
        }

        return view('auth.login', compact('role'));
    }

    /**
     * Proses autentikasi login.
     */
    public function login(Request $request)
    {
        // Menentukan validasi berdasarkan role yang dipilih
        $role = $request->input('role', 'siswa');
        
        $rules = [
            'role' => 'required|in:siswa,petugas',
            'password' => 'required|string',
            'g-recaptcha-response' => ['required', new ReCaptcha],
        ];

        if ($role === 'siswa') {
            $rules['nis'] = 'required|string';
        } else {
            $rules['login_identifier'] = 'required|string'; // Bisa email atau username
        }

        $request->validate($rules, [
            'nis.required' => 'NIS wajib diisi.',
            'login_identifier.required' => 'Username atau Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'g-recaptcha-response.required' => 'Mohon selesaikan verifikasi reCAPTCHA.',
        ]);

        if ($role === 'siswa') {
            // Login Siswa
            $siswa = Siswa::where('nis', $request->input('nis'))->first();

            if (!$siswa || !Hash::check($request->input('password'), $siswa->password)) {
                throw ValidationException::withMessages([
                    'nis' => ['NIS atau password yang Anda masukkan salah.'],
                ]);
            }

            if ($siswa->status !== 'aktif') {
                throw ValidationException::withMessages([
                    'nis' => ['Akun Siswa Anda sudah tidak aktif (status: ' . $siswa->status . ').'],
                ]);
            }

            Auth::guard('siswa')->login($siswa);
        } else {
            // Login Petugas / Admin (Guard: web)
            $identifier = $request->input('login_identifier');
            
            $user = User::where('username', $identifier)
                        ->orWhere('email', $identifier)
                        ->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                throw ValidationException::withMessages([
                    'login_identifier' => ['Username/Email atau password yang dimasukkan salah.'],
                ]);
            }

            if ($user->status !== 'aktif') {
                throw ValidationException::withMessages([
                    'login_identifier' => ['Akun petugas Anda dalam status tidak aktif.'],
                ]);
            }

            Auth::guard('web')->login($user);
        }

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Keluar dari aplikasi (Logout).
     */
    public function logout(Request $request)
    {
        if (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
