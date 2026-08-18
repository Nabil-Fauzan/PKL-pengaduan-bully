<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Siswa | Lapor! Bullying</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50/50 text-slate-900 min-h-screen selection:bg-indigo-500 selection:text-white">

    <!-- Glassmorphic Top Navbar -->
    <header class="sticky top-0 z-40 w-full backdrop-blur-md bg-white/75 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-indigo-600 flex items-center justify-center shadow-md shadow-indigo-200">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <span class="font-extrabold text-slate-900 tracking-tight text-base sm:text-lg">Lapor! Bullying</span>
                    <span class="hidden sm:inline-block text-[10px] bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded-full font-bold ml-2">SMK TI Airlangga</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="hidden md:inline-block text-xs font-semibold text-slate-500">{{ date('d M Y') }}</span>
                <a href="#" onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();" 
                    class="text-xs font-bold text-red-500 hover:text-red-700 transition-colors bg-red-50 hover:bg-red-100/80 px-3.5 py-2 rounded-lg">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Welcome Hero Banner -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-950 via-slate-900 to-indigo-900 text-white p-6 sm:p-8 md:p-10 shadow-xl mb-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,0.15),transparent_45%)]"></div>
            <div class="relative z-10 max-w-2xl">
                <span class="inline-block text-[11px] font-extrabold tracking-wider text-indigo-300 uppercase mb-2 bg-indigo-500/20 px-2.5 py-1 rounded-md">Portal Perlindungan Murid</span>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight mb-2">Halo, {{ $siswa->nama }}!</h1>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-medium">
                    Suara Anda berharga. Laporkan segala bentuk perundungan (bullying) demi menciptakan sekolah yang aman, nyaman, dan ramah untuk kita semua. Laporan Anda dijamin rahasia.
                </p>
            </div>
        </div>

        <!-- Statistics Dashboard Row -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            <!-- Stat 1: Total Reports -->
            <div id="stat-all" onclick="filterByStatus('all')" class="bg-white border-2 border-indigo-500 rounded-2xl p-5 shadow-md flex items-center gap-4 cursor-pointer transition-all duration-300">
                <div class="h-12 w-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400">Total Pengaduan</p>
                    <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $data_pengaduan->count() }}</h3>
                </div>
            </div>

            <!-- Stat 2: In Process -->
            <div id="stat-proses" onclick="filterByStatus('proses')" class="bg-white border-2 border-transparent rounded-2xl p-5 shadow-sm hover:shadow-md flex items-center gap-4 cursor-pointer transition-all duration-300">
                <div class="h-12 w-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400">Dalam Proses</p>
                    <h3 class="text-2xl font-black text-slate-900 mt-0.5">
                        {{ $data_pengaduan->whereIn('status', ['baru', 'diproses'])->count() }}
                    </h3>
                </div>
            </div>

            <!-- Stat 3: Resolved -->
            <div id="stat-selesai" onclick="filterByStatus('selesai')" class="bg-white border-2 border-transparent rounded-2xl p-5 shadow-sm hover:shadow-md flex items-center gap-4 cursor-pointer transition-all duration-300">
                <div class="h-12 w-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400">Laporan Selesai</p>
                    <h3 class="text-2xl font-black text-slate-900 mt-0.5">
                        {{ $data_pengaduan->where('status', 'selesai')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Main Layout Columns -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side: Complaints Feed (2/3 width) -->
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">Laporan Terkini Anda</h2>
                        <p class="text-xs text-slate-400 mt-0.5 font-medium">Daftar keluhan yang Anda kirimkan ke sekolah</p>
                    </div>
                </div>

                <!-- Search and Filters Section -->
                <div class="flex flex-col gap-4 mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <!-- Category Pills Filter -->
                        <div class="flex flex-wrap gap-2">
                            <button onclick="filterByCategory('all')" id="btn-cat-all" class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-indigo-600 text-white shadow-sm border border-indigo-600 transition-all cursor-pointer">Semua Kategori</button>
                            <button onclick="filterByCategory('bullying')" id="btn-cat-bullying" class="px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition-all cursor-pointer">Bullying</button>
                            <button onclick="filterByCategory('fasilitas')" id="btn-cat-fasilitas" class="px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition-all cursor-pointer">Fasilitas</button>
                            <button onclick="filterByCategory('akademik')" id="btn-cat-akademik" class="px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition-all cursor-pointer">Akademik</button>
                            <button onclick="filterByCategory('lainnya')" id="btn-cat-lainnya" class="px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition-all cursor-pointer">Lainnya</button>
                        </div>

                        <!-- Search Input -->
                        <div class="relative w-full sm:w-64">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input type="text" id="search-input" oninput="filterBySearch()" placeholder="Cari judul laporan..." class="block w-full rounded-full border border-slate-200 bg-white pl-9 pr-4 py-1.5 text-xs focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-slate-400 shadow-sm transition-all">
                        </div>
                    </div>

                    <!-- Date Range Filter Row -->
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="inline-flex items-center gap-2 bg-white border border-slate-200/80 rounded-full px-4 py-1.5 shadow-sm text-xs">
                            <span class="text-slate-400 font-semibold flex items-center gap-1">
                                <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Rentang Tanggal:
                            </span>
                            <input type="date" id="filter-date-start" onchange="applyFilters()" class="border-0 focus:ring-0 p-0 text-xs w-28 bg-transparent text-slate-700 outline-none">
                            <span class="text-slate-300 font-semibold">s.d</span>
                            <input type="date" id="filter-date-end" onchange="applyFilters()" class="border-0 focus:ring-0 p-0 text-xs w-28 bg-transparent text-slate-700 outline-none">
                            <button onclick="clearDateFilter()" class="text-red-500 hover:text-red-700 font-bold ml-1 text-sm" title="Reset filter tanggal">&times;</button>
                        </div>
                    </div>
                </div>

                <!-- Success Alert -->
                @if(session('success_message'))
                    <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl p-4 mb-6 text-sm font-medium flex items-center gap-3">
                        <svg class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success_message') }}</span>
                    </div>
                @endif

                @if($data_pengaduan->isEmpty())
                    <!-- Empty State -->
                    <div class="border-2 border-dashed border-slate-200 bg-white rounded-2xl p-10 text-center">
                        <div class="h-14 w-14 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 border border-slate-100">
                            <svg class="h-7 w-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900 mb-1">Tidak Ada Laporan</h3>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto mb-6">Anda saat ini belum memiliki riwayat pengaduan. Semua laporan yang Anda ajukan akan muncul di sini.</p>
                        <a href="{{ route('dashboard.pengaduan.tambah') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-all shadow-sm cursor-pointer hover:shadow-md">
                            Tulis Laporan Pertama
                        </a>
                    </div>
                @else
                    <!-- Complaints Cards Feed -->
                    <div id="complaints-container" class="space-y-4">
                        @foreach($data_pengaduan as $pengaduan)
                            <div class="complaint-card bg-white border border-slate-200/80 rounded-2xl p-5 hover:-translate-y-0.5 hover:shadow-md hover:border-slate-300 transition-all duration-300 group"
                                 data-status="{{ $pengaduan->status }}" 
                                 data-kategori="{{ $pengaduan->kategori }}"
                                 data-tanggal="{{ $pengaduan->tanggal_pengaduan->format('Y-m-d') }}">
                                <div class="flex justify-between items-start gap-4 mb-3">
                                    <div>
                                        <span class="inline-block text-[10px] bg-slate-100 text-slate-700 font-bold px-2.5 py-0.5 rounded-full border border-slate-200/60 mr-2">
                                            {{ ucfirst($pengaduan->kategori) }}
                                        </span>
                                        <span class="text-[10px] font-semibold text-slate-400">
                                            {{ $pengaduan->tanggal_pengaduan->diffForHumans() }}
                                        </span>
                                    </div>
                                    
                                    <!-- Status Badge -->
                                    <div>
                                        @if($pengaduan->isTerabaikan())
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-orange-50 text-orange-700 border border-orange-100">Terabaikan (>3 hari)</span>
                                        @elseif($pengaduan->status === 'baru')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-blue-50 text-blue-700 border border-blue-100">Baru</span>
                                        @elseif($pengaduan->status === 'diproses')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-50 text-amber-700 border border-amber-100">Diproses</span>
                                        @elseif($pengaduan->status === 'selesai')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-100">Selesai</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-50 text-rose-700 border border-rose-100">Ditolak</span>
                                        @endif
                                    </div>
                                </div>

                                <h3 class="font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors text-base mb-2">
                                    {{ $pengaduan->judul }}
                                </h3>
                                
                                <p class="text-xs text-slate-500 leading-relaxed font-medium">
                                    {{ Str::limit($pengaduan->isi_pengaduan, 220) }}
                                </p>

                                <div class="mt-4 pt-3 border-t border-slate-100 flex justify-end">
                                    <a href="{{ route('dashboard.pengaduan.detail', $pengaduan->id_pengaduan) }}" class="text-[11px] font-extrabold text-indigo-600 hover:text-indigo-800 transition-colors flex items-center gap-1">
                                        Lihat Detail & Tanggapan &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right Side: Quick Action & Guide (1/3 width) -->
            <div class="space-y-6">
                <!-- Quotes Card -->
                @php
                    $quotes = [
                        "Berani bersuara hari ini, berarti kamu ikut menciptakan sekolah yang lebih aman untuk semua.",
                        "Jangan diam saat melihat perundungan. Suaramu bisa menjadi awal perubahan yang berarti.",
                        "Setiap laporan adalah langkah kecil menuju sekolah yang lebih aman, nyaman, dan penuh kepedulian.",
                        "Kamu tidak sendirian. Beranilah melapor, karena setiap suara layak didengar dan dilindungi.",
                        "Melapor bukan mencari masalah, tetapi menunjukkan keberanian untuk menghentikan perundungan bersama-sama.",
                        "Ketika kamu bersuara, kamu membantu menciptakan ruang belajar yang lebih aman bagi semua.",
                        "Satu keberanian hari ini dapat menjadi alasan seseorang merasa aman kembali di sekolah.",
                        "Jadilah bagian dari perubahan. Hentikan perundungan dengan keberanian, kepedulian, dan suara.",
                        "Tak perlu takut untuk melapor. Bersama, kita bisa membangun sekolah tanpa ruang bagi perundungan.",
                        "Suaramu mungkin terdengar kecil, tetapi dampaknya bisa besar bagi mereka yang membutuhkan.",
                        "Berani melapor adalah langkah nyata untuk menjaga teman dan menciptakan lingkungan sekolah yang lebih baik.",
                        "Jangan biarkan perundungan menjadi kebiasaan. Satu laporanmu dapat membantu menghentikannya.",
                        "Sekolah yang aman dimulai dari kepedulian. Mari bersama menciptakan lingkungan tanpa perundungan.",
                        "Kepedulianmu hari ini dapat membuat seseorang merasa lebih aman, dihargai, dan tidak sendirian.",
                        "Bersuara bukan berarti lemah. Kamu sedang menunjukkan keberanian untuk membuat perubahan yang lebih baik."
                    ];
                    $randomQuote = $quotes[array_rand($quotes)];
                @endphp
                <div class="bg-gradient-to-br from-indigo-900 to-slate-900 border border-indigo-950 rounded-2xl p-6 text-white relative overflow-hidden shadow-md">
                    <div class="absolute -right-4 -bottom-4 opacity-10 text-white">
                        <svg class="h-24 w-24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.154c-2.433.914-4 3.614-4 5.844h4v10h-10z"/>
                        </svg>
                    </div>
                    <h4 class="text-[10px] font-extrabold tracking-widest text-indigo-300 uppercase mb-3">Kutipan Hari Ini</h4>
                    <p class="text-xs leading-relaxed font-semibold italic text-slate-100 mb-4">
                        "{{ $randomQuote }}"
                    </p>
                    <span class="text-[10px] text-indigo-300 font-bold block">— Tim Perlindungan Murid</span>
                </div>

                <!-- Action Card -->
                <div class="bg-gradient-to-b from-indigo-50 to-white border border-indigo-100 rounded-2xl p-6 text-center">
                    <h3 class="text-base font-extrabold text-indigo-950 mb-1">Ingin Melapor Sesuatu?</h3>
                    <p class="text-xs text-indigo-700 mb-5 font-medium leading-relaxed">Laporkan secara aman jika Anda atau teman Anda mengalami tindakan intimidasi atau kekerasan.</p>
                    <a href="{{ route('dashboard.pengaduan.tambah') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all hover:-translate-y-0.5 cursor-pointer">
                        Buat Laporan Baru
                    </a>
                </div>

                <!-- Guidelines Card -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6">
                    <h3 class="text-sm font-extrabold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Langkah Penanganan
                    </h3>
                    
                    <div class="relative pl-6 border-l-2 border-indigo-100 space-y-6 text-xs">
                        <!-- Step 1 -->
                        <div class="relative">
                            <div class="absolute -left-[31px] top-0.5 h-4.5 w-4.5 rounded-full bg-indigo-600 border-4 border-white flex items-center justify-center"></div>
                            <h4 class="font-extrabold text-slate-900">1. Kirim Laporan</h4>
                            <p class="text-slate-400 mt-1 font-medium leading-relaxed">Murid mengirimkan laporan kasus perundungan secara aman lewat formulir portal.</p>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="relative">
                            <div class="absolute -left-[31px] top-0.5 h-4.5 w-4.5 rounded-full bg-slate-300 border-4 border-white flex items-center justify-center"></div>
                            <h4 class="font-extrabold text-slate-800">2. Proses Investigasi</h4>
                            <p class="text-slate-400 mt-1 font-medium leading-relaxed">Petugas guru BK / Bimbingan Konseling akan meneliti kasus dan memanggil pihak terkait.</p>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="relative">
                            <div class="absolute -left-[31px] top-0.5 h-4.5 w-4.5 rounded-full bg-slate-300 border-4 border-white flex items-center justify-center"></div>
                            <h4 class="font-extrabold text-slate-800">3. Solusi & Selesai</h4>
                            <p class="text-slate-400 mt-1 font-medium leading-relaxed">Setelah investigasi tuntas, kasus ditutup dan status laporan berubah menjadi selesai.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Accordion Card -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-sm font-extrabold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        FAQ Keamanan & BK
                    </h3>
                    
                    <div class="space-y-3">
                        <!-- FAQ Item 1 -->
                        <div class="border-b border-slate-100 pb-3">
                            <button onclick="toggleFaq(1)" class="w-full flex justify-between items-center text-left text-xs font-bold text-slate-800 hover:text-indigo-600 transition-colors focus:outline-none">
                                <span>Apakah laporan saya anonim/rahasia?</span>
                                <svg id="faq-icon-1" class="h-3 w-3 text-slate-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <p id="faq-answer-1" class="hidden text-[11px] text-slate-500 mt-2 leading-relaxed">
                                Ya. Laporan Anda hanya dapat diakses oleh Admin Sistem dan Tim Guru BK. Teman sekelas atau pihak terlapor tidak akan mengetahui identitas Anda tanpa izin khusus untuk keperluan investigasi berat.
                            </p>
                        </div>
                        
                        <!-- FAQ Item 2 -->
                        <div class="border-b border-slate-100 pb-3">
                            <button onclick="toggleFaq(2)" class="w-full flex justify-between items-center text-left text-xs font-bold text-slate-800 hover:text-indigo-600 transition-colors focus:outline-none">
                                <span>Berapa lama laporan direspon BK?</span>
                                <svg id="faq-icon-2" class="h-3 w-3 text-slate-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <p id="faq-answer-2" class="hidden text-[11px] text-slate-500 mt-2 leading-relaxed">
                                Tim Guru BK berkomitmen meninjau laporan Anda dalam kurun waktu 2x24 jam hari kerja. Status laporan akan diperbarui menjadi "Diproses" segera setelah penelusuran dimulai.
                            </p>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="pb-1">
                            <button onclick="toggleFaq(3)" class="w-full flex justify-between items-center text-left text-xs font-bold text-slate-800 hover:text-indigo-600 transition-colors focus:outline-none">
                                <span>Bagaimana jika pelaku mengancam?</span>
                                <svg id="faq-icon-3" class="h-3 w-3 text-slate-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <p id="faq-answer-3" class="hidden text-[11px] text-slate-500 mt-2 leading-relaxed">
                                Tuliskan situasi ancaman tersebut di isi laporan. Sekolah memiliki protokol perlindungan fisik dan mental khusus untuk murid pelapor guna menjamin keselamatan Anda selama berada di lingkungan sekolah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- Client-Side Filter Script -->
    <script>
        let currentStatusFilter = 'all';
        let currentCategoryFilter = 'all';
        let currentSearchQuery = '';

        function filterByStatus(status) {
            currentStatusFilter = status;
            
            // Update active states of stat cards
            const statCards = {
                'all': document.getElementById('stat-all'),
                'proses': document.getElementById('stat-proses'),
                'selesai': document.getElementById('stat-selesai')
            };
            
            Object.keys(statCards).forEach(key => {
                if (!statCards[key]) return;
                if (key === status) {
                    statCards[key].className = "bg-white border-2 border-indigo-500 rounded-2xl p-5 shadow-md flex items-center gap-4 cursor-pointer transition-all duration-300";
                } else {
                    statCards[key].className = "bg-white border-2 border-transparent rounded-2xl p-5 shadow-sm hover:shadow-md flex items-center gap-4 cursor-pointer transition-all duration-300";
                }
            });

            applyFilters();
        }

        function filterByCategory(category) {
            currentCategoryFilter = category;
            
            // Update active states of filter buttons
            const categoryButtons = {
                'all': document.getElementById('btn-cat-all'),
                'bullying': document.getElementById('btn-cat-bullying'),
                'fasilitas': document.getElementById('btn-cat-fasilitas'),
                'akademik': document.getElementById('btn-cat-akademik'),
                'lainnya': document.getElementById('btn-cat-lainnya')
            };
            
            Object.keys(categoryButtons).forEach(key => {
                if (!categoryButtons[key]) return;
                if (key === category) {
                    categoryButtons[key].className = "px-3.5 py-1.5 rounded-full text-xs font-bold bg-indigo-600 text-white shadow-sm border border-indigo-600 transition-all cursor-pointer";
                } else {
                    categoryButtons[key].className = "px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition-all cursor-pointer";
                }
            });

            applyFilters();
        }

        function filterBySearch() {
            const searchInput = document.getElementById('search-input');
            currentSearchQuery = searchInput.value.toLowerCase().trim();
            applyFilters();
        }

        function clearDateFilter() {
            document.getElementById('filter-date-start').value = '';
            document.getElementById('filter-date-end').value = '';
            applyFilters();
        }

        function toggleFaq(index) {
            const answer = document.getElementById(`faq-answer-${index}`);
            const icon = document.getElementById(`faq-icon-${index}`);
            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                answer.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        function applyFilters() {
            const cards = document.querySelectorAll('.complaint-card');
            let visibleCount = 0;

            const startDateStr = document.getElementById('filter-date-start').value;
            const endDateStr = document.getElementById('filter-date-end').value;

            cards.forEach(card => {
                const status = card.getAttribute('data-status');
                const category = card.getAttribute('data-kategori');
                const cardDateStr = card.getAttribute('data-tanggal');
                
                // Get title text for searching
                const titleElement = card.querySelector('h3');
                const titleText = titleElement ? titleElement.textContent.toLowerCase() : '';

                // Determine status match
                let statusMatch = false;
                if (currentStatusFilter === 'all') {
                    statusMatch = true;
                } else if (currentStatusFilter === 'proses') {
                    statusMatch = (status === 'baru' || status === 'diproses');
                } else if (currentStatusFilter === 'selesai') {
                    statusMatch = (status === 'selesai');
                }

                // Determine category match
                let categoryMatch = (currentCategoryFilter === 'all' || category === currentCategoryFilter);

                // Determine search query match
                let searchMatch = (currentSearchQuery === '' || titleText.includes(currentSearchQuery));

                // Determine date range match
                let dateMatch = true;
                if (cardDateStr) {
                    const cardDate = new Date(cardDateStr);
                    cardDate.setHours(0,0,0,0);

                    if (startDateStr) {
                        const startDate = new Date(startDateStr);
                        startDate.setHours(0,0,0,0);
                        if (cardDate < startDate) {
                            dateMatch = false;
                        }
                    }
                    if (endDateStr) {
                        const endDate = new Date(endDateStr);
                        endDate.setHours(23,59,59,999);
                        if (cardDate > endDate) {
                            dateMatch = false;
                        }
                    }
                }

                if (statusMatch && categoryMatch && searchMatch && dateMatch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Handle empty state during filter
            const container = document.getElementById('complaints-container');
            let tempEmptyState = document.getElementById('filter-empty-state');
            
            if (visibleCount === 0 && cards.length > 0) {
                if (!tempEmptyState) {
                    tempEmptyState = document.createElement('div');
                    tempEmptyState.id = 'filter-empty-state';
                    tempEmptyState.className = 'border-2 border-dashed border-slate-200 bg-white rounded-2xl p-10 text-center';
                    tempEmptyState.innerHTML = `
                        <div class="h-14 w-14 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 border border-slate-100">
                            <svg class="h-7 w-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900 mb-1">Tidak Ada Hasil</h3>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">Tidak ada laporan yang cocok dengan kriteria pencarian dan filter aktif Anda.</p>
                    `;
                    container.parentNode.appendChild(tempEmptyState);
                }
            } else {
                if (tempEmptyState) {
                    tempEmptyState.remove();
                }
            }
        }
    </script>
</body>
</html>
