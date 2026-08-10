<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white border border-slate-200 rounded-xl shadow-sm p-6 sm:p-8 text-center">
        <h1 class="text-2xl font-bold text-slate-900 mb-2">Dashboard Siswa</h1>
        <p class="text-sm text-slate-500 mb-6">Selamat datang, {{ $siswa->nama }} (NIS: {{ $siswa->nis }})</p>
        
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
