<?php
    $role = $role ?? old('role', request()->query('role', 'siswa'));
    if (!in_array($role, ['siswa', 'petugas'])) {
        $role = 'siswa';
    }
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Layanan Pengaduan Bullying</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Dark Mode styles */
        body.dark-mode {
            background-color: #0f172a !important; /* Slate 900 */
            color: #f8fafc !important; /* Slate 50 */
        }
        
        .dark-mode .bg-white {
            background-color: #1e293b !important; /* Slate 800 */
            border-color: #334155 !important; /* Slate 700 */
            color: #f8fafc !important;
        }

        .dark-mode .text-slate-900,
        .dark-mode .text-slate-800 {
            color: #f8fafc !important;
        }

        .dark-mode .text-slate-500,
        .dark-mode .text-slate-400 {
            color: #94a3b8 !important; /* Slate 400 */
        }

        .dark-mode .border-slate-200,
        .dark-mode .border-slate-300 {
            border-color: #334155 !important;
        }

        .dark-mode input {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #f8fafc !important;
        }

        .dark-mode input::placeholder {
            color: #64748b !important;
        }

        .dark-mode .bg-red-50 {
            background-color: rgba(239, 68, 68, 0.12) !important;
            border-color: rgba(239, 68, 68, 0.25) !important;
        }

        .dark-mode .text-red-800,
        .dark-mode .text-red-700 {
            color: #fca5a5 !important;
        }
    </style>

    <!-- Immediate Theme Initialization to avoid white flash -->
    <script>
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.documentElement.classList.add('dark');
            document.addEventListener('DOMContentLoaded', () => {
                document.body.classList.add('dark-mode');
                const sunIcon = document.getElementById('sun-icon');
                const moonIcon = document.getElementById('moon-icon');
                if (sunIcon && moonIcon) {
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                }
            });
        }
    </script>
    
    <!-- reCAPTCHA API with explicit render callback -->
    <script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">

    <!-- Top Navigation Theme Toggle -->
    <div class="fixed top-4 right-4 z-50">
        <button type="button" id="dark-mode-toggle" class="p-2.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-all shadow-sm cursor-pointer outline-none" title="Ubah Tema">
            <!-- Sun Icon (visible in dark mode) -->
            <svg id="sun-icon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
            </svg>
            <!-- Moon Icon (visible in light mode) -->
            <svg id="moon-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>
    </div>

    <div class="max-w-md w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden p-6 sm:p-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center space-x-2 mb-3 group">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-sm transition-transform duration-200 group-hover:scale-110">
                    L
                </div>
                <span class="text-lg font-bold text-slate-900">Lapor! Bullying</span>
            </a>
            <h2 class="text-2xl font-bold text-slate-900">Selamat Datang Kembali</h2>
            <p class="text-sm text-slate-500 mt-1">Silakan masuk untuk mengakses layanan pengaduan</p>
        </div>

        <!-- Role Tabs -->
        <div class="flex border-b border-slate-200 mb-6">
            <button type="button" id="tab-siswa" onclick="switchRole('siswa')" 
                class="flex-1 pb-3 text-sm font-semibold text-center border-b-2 active:scale-[0.97] transition-all duration-200 outline-none cursor-pointer {{ $role === 'siswa' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                Siswa
            </button>
            <button type="button" id="tab-petugas" onclick="switchRole('petugas')" 
                class="flex-1 pb-3 text-sm font-semibold text-center border-b-2 active:scale-[0.97] transition-all duration-200 outline-none cursor-pointer {{ $role === 'petugas' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                Petugas / Admin
            </button>
        </div>

        <!-- Global Errors -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-100 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-red-800">Ada kesalahan saat masuk:</h3>
                        <ul class="text-xs text-red-700 list-disc list-inside mt-1 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <!-- Hidden Role Input -->
            <input type="hidden" name="role" id="role-input" value="{{ $role }}">

            <!-- Siswa Input fields -->
            <div id="field-siswa" class="{{ $role === 'siswa' ? '' : 'hidden' }} mb-4">
                <label for="nis" class="block text-sm font-semibold text-slate-800 mb-2">NIS (Nomor Induk Siswa)</label>
                <div class="relative rounded-md">
                    <input type="text" name="nis" id="nis" value="{{ old('nis') }}" 
                        placeholder="Masukkan NIS Anda..." 
                        class="block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 hover:border-slate-400 transition-all duration-200 placeholder-slate-400">
                </div>
            </div>

            <!-- Petugas Input fields -->
            <div id="field-petugas" class="{{ $role === 'petugas' ? '' : 'hidden' }} mb-4">
                <label for="login_identifier" class="block text-sm font-semibold text-slate-800 mb-2">Username atau Email</label>
                <div class="relative rounded-md">
                    <input type="text" name="login_identifier" id="login_identifier" value="{{ old('login_identifier') }}" 
                        placeholder="Masukkan username atau email..." 
                        class="block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 hover:border-slate-400 transition-all duration-200 placeholder-slate-400">
                </div>
            </div>

            <!-- Password (Shared) -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="text-sm font-semibold text-slate-800">Password</label>
                </div>
                <div class="relative rounded-md">
                    <input type="password" name="password" id="password" 
                        placeholder="••••••••" 
                        class="block w-full rounded-lg border border-slate-300 pl-4 pr-10 py-2.5 text-sm outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 hover:border-slate-400 transition-all duration-200 placeholder-slate-400">
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-650 focus:outline-none cursor-pointer">
                        <!-- Open Eye Icon -->
                        <svg id="eye-open" class="h-5 w-5 transition-transform active:scale-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Closed Eye Icon (hidden by default) -->
                        <svg id="eye-closed" class="h-5 w-5 hidden transition-transform active:scale-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- reCAPTCHA Widget Container -->
            <div id="recaptcha-wrapper" class="mb-6 flex justify-center min-h-[78px]">
                <div id="recaptcha-widget"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] transition-all duration-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm mb-4 cursor-pointer">
                Masuk ke Aplikasi
            </button>

            <!-- Back link -->
            <a href="/" class="block text-center text-xs font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                &larr; Kembali ke Beranda
            </a>
        </form>
    </div>

    <!-- Javascript tab switcher & Theme Logic -->
    <script>
        function switchRole(role) {
            const tabSiswa = document.getElementById('tab-siswa');
            const tabPetugas = document.getElementById('tab-petugas');
            const fieldSiswa = document.getElementById('field-siswa');
            const fieldPetugas = document.getElementById('field-petugas');
            const roleInput = document.getElementById('role-input');

            // Set role value
            roleInput.value = role;

            if (role === 'siswa') {
                // Style tabs
                tabSiswa.className = "flex-1 pb-3 text-sm font-semibold text-center border-b-2 border-indigo-600 text-indigo-600 active:scale-[0.97] transition-all duration-200 outline-none cursor-pointer";
                tabPetugas.className = "flex-1 pb-3 text-sm font-semibold text-center border-b-2 border-transparent text-slate-500 hover:text-slate-700 active:scale-[0.97] transition-all duration-200 outline-none cursor-pointer";
                
                // Show/hide fields
                fieldSiswa.classList.remove('hidden');
                fieldPetugas.classList.add('hidden');
            } else {
                // Style tabs
                tabSiswa.className = "flex-1 pb-3 text-sm font-semibold text-center border-b-2 border-transparent text-slate-500 hover:text-slate-700 active:scale-[0.97] transition-all duration-200 outline-none cursor-pointer";
                tabPetugas.className = "flex-1 pb-3 text-sm font-semibold text-center border-b-2 border-indigo-600 text-indigo-600 active:scale-[0.97] transition-all duration-200 outline-none cursor-pointer";
                
                // Show/hide fields
                fieldSiswa.classList.add('hidden');
                fieldPetugas.classList.remove('hidden');
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        // reCAPTCHA Dynamic Theme Logic
        let recaptchaWidgetId = null;

        function getActiveTheme() {
            return (document.body.classList.contains('dark-mode') || localStorage.getItem('dark-mode') === 'enabled') ? 'dark' : 'light';
        }

        function renderRecaptchaWidget(theme) {
            const wrapper = document.getElementById('recaptcha-wrapper');
            if (!wrapper) return;

            // Fresh inner element to detach previous Google iframe instance
            wrapper.innerHTML = '<div id="recaptcha-widget"></div>';

            if (typeof grecaptcha !== 'undefined' && grecaptcha.render) {
                try {
                    recaptchaWidgetId = grecaptcha.render('recaptcha-widget', {
                        'sitekey': '{{ config('services.recaptcha.sitekey') }}',
                        'theme': theme
                    });
                } catch (e) {
                    console.error('reCAPTCHA render error:', e);
                }
            }
        }

        window.onRecaptchaLoad = function() {
            renderRecaptchaWidget(getActiveTheme());
        };

        // Dark Mode Switcher Logic
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');

        function enableDarkMode() {
            document.body.classList.add('dark-mode');
            document.documentElement.classList.add('dark');
            if (sunIcon && moonIcon) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
            localStorage.setItem('dark-mode', 'enabled');
            renderRecaptchaWidget('dark');
        }

        function disableDarkMode() {
            document.body.classList.remove('dark-mode');
            document.documentElement.classList.remove('dark');
            if (sunIcon && moonIcon) {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
            localStorage.setItem('dark-mode', 'disabled');
            renderRecaptchaWidget('light');
        }

        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', () => {
                if (document.body.classList.contains('dark-mode')) {
                    disableDarkMode();
                } else {
                    enableDarkMode();
                }
            });
        }

        if (localStorage.getItem('dark-mode') === 'enabled') {
            enableDarkMode();
        }

        // Safety fallback: if reCAPTCHA script loaded before callback bound
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                if (typeof grecaptcha !== 'undefined' && grecaptcha.render && !recaptchaWidgetId) {
                    renderRecaptchaWidget(getActiveTheme());
                }
            }, 300);
        });
    </script>
</body>
</html>
