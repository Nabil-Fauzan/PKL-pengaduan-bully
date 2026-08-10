<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layanan Pengaduan Bullying - SMK TI Airlangga</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col justify-between selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo / Title -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">
                        L
                    </div>
                    <div>
                        <h1 class="text-base font-bold text-slate-900 leading-tight">Lapor! Bullying</h1>
                        <p class="text-xs text-slate-500">SMK TI Airlangga</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex items-center space-x-4">
                    <a href="#alur" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Alur</a>
                    <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 border border-indigo-200 hover:border-indigo-600 px-4 py-2 rounded-lg transition-all">
                        Masuk Siswa
                    </a>
                    <!-- We will direct petugas/admin to user login later, but for now placeholder or direct to same login -->
                    <a href="{{ route('login') }}?role=petugas" class="text-sm font-medium text-slate-700 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg transition-colors">
                        Portal Petugas
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-center">
            <div class="max-w-3xl mx-auto">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100 mb-6">
                    Aman, Rahasia, & Terpercaya
                </span>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">
                    Berani Bicara, Hentikan <span class="text-indigo-600">Bullying</span> di Sekolah Kita
                </h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-8">
                    Layanan pengaduan bagi siswa SMK TI Airlangga untuk melaporkan tindakan perundungan (bullying), masalah fasilitas, akademik, atau hal lainnya secara aman dan rahasia.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-colors">
                        Laporkan Sekarang (Login Siswa)
                    </a>
                    <a href="#alur" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-slate-300 text-base font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors">
                        Pelajari Alur Pengaduan
                    </a>
                </div>
            </div>
        </section>

        <!-- Stats Section (Flat styling) -->
        <section class="bg-white border-y border-slate-200 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="p-6">
                        <div class="text-3xl font-extrabold text-indigo-600">100%</div>
                        <div class="text-sm font-semibold text-slate-800 mt-2">Identitas Terjaga</div>
                        <p class="text-xs text-slate-500 mt-1">Laporan diproses secara rahasia dan aman demi kenyamanan pelapor.</p>
                    </div>
                    <div class="p-6 border-t md:border-t-0 md:border-x border-slate-200">
                        <div class="text-3xl font-extrabold text-indigo-600">Responsif</div>
                        <div class="text-sm font-semibold text-slate-800 mt-2">Penanganan Cepat</div>
                        <p class="text-xs text-slate-500 mt-1">Setiap laporan yang masuk akan segera ditindaklanjuti oleh petugas sekolah.</p>
                    </div>
                    <div class="p-6 border-t md:border-t-0 border-slate-200">
                        <div class="text-3xl font-extrabold text-indigo-600">Transparan</div>
                        <div class="text-sm font-semibold text-slate-800 mt-2">Pantau Status</div>
                        <p class="text-xs text-slate-500 mt-1">Siswa dapat memantau perkembangan status laporan mereka secara real-time.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Alur Section -->
        <section id="alur" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-slate-900">Alur Pengaduan Siswa</h3>
                <p class="text-slate-500 mt-2">Cara mudah melaporkan dan memantau masalah di lingkungan sekolah</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 font-bold rounded-lg flex items-center justify-center mb-4">
                        1
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Masuk/Login</h4>
                    <p class="text-sm text-slate-600">Siswa masuk ke aplikasi dengan menggunakan NIS (Nomor Induk Siswa) dan password masing-masing.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 font-bold rounded-lg flex items-center justify-center mb-4">
                        2
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Tulis Laporan</h4>
                    <p class="text-sm text-slate-600">Buat laporan baru dengan menulis judul, kategori masalah (bullying, dll), dan isi pengaduan lengkap.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 font-bold rounded-lg flex items-center justify-center mb-4">
                        3
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Tinjauan Petugas</h4>
                    <p class="text-sm text-slate-600">Petugas sekolah akan memeriksa kebenaran laporan, memberikan tanggapan, dan memperbarui status.</p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 font-bold rounded-lg flex items-center justify-center mb-4">
                        4
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Laporan Selesai</h4>
                    <p class="text-sm text-slate-600">Pantau proses pengaduan Anda langsung dari dashboard siswa sampai selesai ditangani.</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-500">
            <p>&copy; {{ date('Y') }} SMK TI Airlangga. All rights reserved.</p>
            <p class="mt-1 text-xs text-slate-400">Dibuat untuk sarana pelaporan dan pencegahan perundungan di sekolah.</p>
        </div>
    </footer>

</body>
</html>
