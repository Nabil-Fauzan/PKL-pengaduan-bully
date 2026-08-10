<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Petugas / Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white border border-slate-200 rounded-xl shadow-sm p-6 sm:p-8 text-center">
        <h1 class="text-2xl font-bold text-slate-900 mb-2">Dashboard Petugas / Admin</h1>
        <p class="text-sm text-slate-500 mb-1">Selamat datang, {{ $user->nama }} (Username: {{ $user->username }})</p>
        <p class="text-xs text-indigo-600 font-semibold mb-6">Hak Akses: {{ ucfirst($user->role) }}</p>
        
        <!-- Text Logout Link -->
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
            class="text-sm font-semibold text-red-600 hover:text-red-800 transition-colors">
            Keluar (Logout)
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</body>
</html>
