<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pengaduan | Lapor! Bullying</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

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
        .dark-mode .text-slate-700 {
            color: #cbd5e1 !important; /* Slate 300 */
        }
        .dark-mode .text-slate-500,
        .dark-mode .text-slate-400 {
            color: #94a3b8 !important; /* Slate 400 */
        }
        .dark-mode .border-slate-200,
        .dark-mode .border-slate-150 {
            border-color: #334155 !important;
        }
        /* bg-slate-50 for details container */
        .dark-mode .bg-slate-50 {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #cbd5e1 !important;
        }
        /* Estimation banner */
        .dark-mode .bg-amber-50\/60 {
            background-color: rgba(245, 158, 11, 0.1) !important;
            border-color: rgba(245, 158, 11, 0.2) !important;
        }
        .dark-mode .text-amber-850 {
            color: #fef08a !important;
        }
        .dark-mode .text-amber-900 {
            color: #fef9c3 !important;
        }
        /* bg-slate-100 badges */
        .dark-mode .bg-slate-100 {
            background-color: #334155 !important;
            border-color: #475569 !important;
            color: #cbd5e1 !important;
        }
    </style>
</head>
<body class="bg-slate-50/50 text-slate-900 min-h-screen p-4 sm:p-6 md:p-8 flex items-center justify-center">

    <div class="max-w-3xl w-full bg-white border border-slate-200 rounded-xl shadow-sm p-6 sm:p-8">
        
        <!-- Header Actions -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors flex items-center gap-1">
                &larr; Kembali ke Dashboard
            </a>
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-extrabold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md flex items-center gap-1.5">
                    <span>ID: #{{ $pengaduan->id_pengaduan }}</span>
                    <button onclick="copyComplaintId('{{ $pengaduan->id_pengaduan }}', this)" class="text-indigo-600 hover:text-indigo-800 focus:outline-none cursor-pointer" title="Salin ID Laporan">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                        </svg>
                    </button>
                </span>
            </div>
        </div>

        <!-- Complaint Info Header -->
        <div class="border-b border-slate-150 pb-6 mb-6">
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <span class="inline-block text-[10px] bg-slate-100 text-slate-700 font-bold px-2.5 py-0.5 rounded-full border border-slate-200">
                    Kategori: {{ ucfirst($pengaduan->kategori) }}
                </span>
                <span class="text-[10px] font-semibold text-slate-400">
                    Dilaporkan pada {{ $pengaduan->tanggal_pengaduan->format('d F Y | H:i') }} WIB
                </span>
                
                <!-- Status Badge -->
                <div class="ml-auto">
                    @if($pengaduan->isTerabaikan())
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-extrabold bg-orange-50 text-orange-700 border border-orange-100">Terabaikan (>3 hari)</span>
                    @elseif($pengaduan->status === 'baru')
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-extrabold bg-blue-50 text-blue-700 border border-blue-100">Baru</span>
                    @elseif($pengaduan->status === 'diproses')
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-100">Diproses</span>
                    @elseif($pengaduan->status === 'selesai')
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-100">Selesai</span>
                    @else
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-100">Ditolak</span>
                    @endif
                </div>
            </div>
            
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight leading-snug">
                {{ $pengaduan->judul }}
            </h1>
        </div>

        <!-- Report Content -->
        <div class="mb-8">
            <h3 class="text-xs font-extrabold tracking-wider text-slate-400 uppercase mb-3">Isi Laporan / Detail Kejadian:</h3>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-sm text-slate-700 leading-relaxed whitespace-pre-line font-medium">
                {{ $pengaduan->isi_pengaduan }}
            </div>
        </div>

        @if($pengaduan->status === 'baru')
            <div class="mb-8 flex items-center gap-3 text-xs text-amber-850 bg-amber-50/60 border border-amber-100 rounded-xl p-4 leading-relaxed font-medium">
                <svg class="h-5 w-5 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                    <strong class="font-extrabold text-amber-900">Estimasi Peninjauan:</strong> Laporan baru biasanya ditinjau oleh guru BK dalam waktu maksimal <span class="font-bold text-amber-900">2x24 jam kerja</span>. Terima kasih atas kesabaran Anda.
                </span>
            </div>
        @endif

        <!-- Counselor Response Section -->
        <div class="border-t border-slate-150 pt-8">
            <h2 class="text-sm font-extrabold tracking-wider text-slate-400 uppercase mb-4 flex items-center gap-1.5">
                <svg class="h-4.5 w-4.5 text-indigo-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                Tanggapan Petugas / Guru BK
            </h2>

            @if($pengaduan->tanggapan->isEmpty())
                <div class="bg-indigo-50/40 border border-indigo-100 rounded-xl p-5 text-center">
                    <p class="text-xs font-semibold text-indigo-900 leading-relaxed">
                        Belum ada tanggapan tertulis untuk laporan ini. Laporan Anda sedang dalam proses peninjauan oleh tim bimbingan konseling (BK) sekolah. Mohon pantau halaman ini secara berkala.
                    </p>
                </div>
            @else
                <!-- Timeline response -->
                <div class="space-y-4">
                    @foreach($pengaduan->tanggapan as $tanggapan)
                        <div class="bg-indigo-50/20 border border-indigo-150 rounded-xl p-5">
                            <div class="flex justify-between items-center border-b border-indigo-100/60 pb-2.5 mb-3 text-[10px]">
                                <span class="font-extrabold text-indigo-950">
                                    Petugas: <span class="text-indigo-600">{{ $tanggapan->petugas->nama ?? 'Guru BK / Petugas' }}</span>
                                </span>
                                <span class="font-semibold text-slate-400">
                                    {{ $tanggapan->tanggal_tanggapan->format('d M Y | H:i') }} WIB
                                </span>
                            </div>
                            <p class="text-xs text-slate-700 leading-relaxed font-medium whitespace-pre-line">
                                {{ $tanggapan->isi_tanggapan }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Footer actions -->
        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
            <a href="#" onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();" 
                class="text-xs font-bold text-red-500 hover:text-red-750 transition-colors">
                Keluar (Logout)
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>

    </div>
    <!-- Clipboard Copy Script -->
    <script>
        function copyComplaintId(id, buttonElement) {
            navigator.clipboard.writeText(id).then(() => {
                const originalHtml = buttonElement.innerHTML;
                buttonElement.innerHTML = `
                    <svg class="h-3 w-3 text-emerald-600 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                `;

                setTimeout(() => {
                    buttonElement.innerHTML = originalHtml;
                }, 1500);
            }).catch(err => {
                console.error('Failed to copy ID: ', err);
            });
        }

        // Apply dark mode theme if enabled in local storage
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('dark-mode') === 'enabled') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
</body>
</html>
