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

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    
    <!-- reCAPTCHA API -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden p-6 sm:p-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center space-x-2 mb-3">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-sm">
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
                class="flex-1 pb-3 text-sm font-semibold text-center border-b-2 transition-all {{ $role === 'siswa' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                Siswa
            </button>
            <button type="button" id="tab-petugas" onclick="switchRole('petugas')" 
                class="flex-1 pb-3 text-sm font-semibold text-center border-b-2 transition-all {{ $role === 'petugas' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
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
                <div class="relative rounded-md shadow-sm">
                    <input type="text" name="nis" id="nis" value="{{ old('nis') }}" 
                        placeholder="Masukkan NIS Anda..." 
                        class="block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-slate-400">
                </div>
            </div>

            <!-- Petugas Input fields -->
            <div id="field-petugas" class="{{ $role === 'petugas' ? '' : 'hidden' }} mb-4">
                <label for="login_identifier" class="block text-sm font-semibold text-slate-800 mb-2">Username atau Email</label>
                <div class="relative rounded-md shadow-sm">
                    <input type="text" name="login_identifier" id="login_identifier" value="{{ old('login_identifier') }}" 
                        placeholder="Masukkan username atau email..." 
                        class="block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-slate-400">
                </div>
            </div>

            <!-- Password (Shared) -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="text-sm font-semibold text-slate-800">Password</label>
                </div>
                <div class="relative rounded-md shadow-sm">
                    <input type="password" name="password" id="password" 
                        placeholder="••••••••" 
                        class="block w-full rounded-lg border border-slate-300 pl-4 pr-10 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-slate-400">
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none cursor-pointer">
                        <!-- Open Eye Icon -->
                        <svg id="eye-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Closed Eye Icon (hidden by default) -->
                        <svg id="eye-closed" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- reCAPTCHA Widget -->
            <div class="mb-6 flex justify-center">
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors shadow-sm mb-4">
                Masuk ke Aplikasi
            </button>

            <!-- Back link -->
            <a href="/" class="block text-center text-xs font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                &larr; Kembali ke Beranda
            </a>
        </form>
    </div>

    <!-- Javascript tab switcher -->
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
                tabSiswa.className = "flex-1 pb-3 text-sm font-semibold text-center border-b-2 border-indigo-600 text-indigo-600 transition-all";
                tabPetugas.className = "flex-1 pb-3 text-sm font-semibold text-center border-b-2 border-transparent text-slate-500 hover:text-slate-700 transition-all";
                
                // Show/hide fields
                fieldSiswa.classList.remove('hidden');
                fieldPetugas.classList.add('hidden');
            } else {
                // Style tabs
                tabSiswa.className = "flex-1 pb-3 text-sm font-semibold text-center border-b-2 border-transparent text-slate-500 hover:text-slate-700 transition-all";
                tabPetugas.className = "flex-1 pb-3 text-sm font-semibold text-center border-b-2 border-indigo-600 text-indigo-600 transition-all";
                
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
    </script>
</body>
</html>
