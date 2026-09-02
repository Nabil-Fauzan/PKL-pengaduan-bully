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
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Dark Mode styles */
        body.dark-mode {
            background-color: #0f172a !important; /* Slate 900 */
            color: #f8fafc !important; /* Slate 50 */
        }
        
        .dark-mode header,
        .dark-mode footer {
            background-color: rgba(15, 23, 42, 0.85) !important;
            border-color: #1e293b !important;
        }
        
        .dark-mode header h1,
        .dark-mode header span {
            color: #f8fafc !important;
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

        .dark-mode .text-slate-600,
        .dark-mode .text-slate-500,
        .dark-mode .text-slate-400 {
            color: #94a3b8 !important; /* Slate 400 */
        }

        .dark-mode .border-slate-200,
        .dark-mode .border-slate-100 {
            border-color: #334155 !important;
        }

        /* Custom styles for interactive step cards */
        .step-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .step-card:hover {
            transform: translateY(-4px);
            border-color: #6366f1 !important;
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.1) !important;
        }
        
        .dark-mode .step-card:hover {
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.25) !important;
        }

        /* Dark Mode support for status badges */
        .dark-mode .bg-indigo-50 {
            background-color: #312e81 !important;
            color: #e0e7ff !important;
        }
        .dark-mode .bg-indigo-100 {
            background-color: #1e1b4b !important;
            color: #c7d2fe !important;
        }

        /* Dark mode support for FAQ borders */
        .dark-mode .border-slate-100 {
            border-color: #334155 !important;
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
                <nav class="flex items-center space-x-1.5 sm:space-x-3 md:space-x-4">
                    <a href="#alur" class="hidden sm:inline-block text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Alur</a>
                    <a href="#faq" class="hidden sm:inline-block text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors mr-1">FAQ</a>
                    
                    <!-- Dark Mode Toggle -->
                    <button type="button" id="dark-mode-toggle" class="p-1.5 sm:p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors cursor-pointer outline-none" title="Ubah Tema">
                        <!-- Sun Icon (visible in dark mode) -->
                        <svg id="sun-icon" class="h-4.5 w-4.5 sm:h-5 sm:w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                        </svg>
                        <!-- Moon Icon (visible in light mode) -->
                        <svg id="moon-icon" class="h-4.5 w-4.5 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <a href="{{ route('login') }}" class="text-xs sm:text-sm font-semibold text-indigo-600 hover:text-indigo-700 border border-indigo-200 hover:border-indigo-600 px-2.5 py-1.5 sm:px-4 sm:py-2 rounded-lg transition-all">
                        Masuk Siswa
                    </a>
                    <a href="{{ route('login') }}?role=petugas" class="hidden sm:inline-block text-xs sm:text-sm font-semibold text-slate-700 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 px-2.5 py-1.5 sm:px-4 sm:py-2 rounded-lg transition-colors">
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
                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-colors active:scale-[0.98]">
                        Laporkan Sekarang (Login Siswa)
                    </a>
                    <a href="#alur" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-slate-300 text-base font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors active:scale-[0.98]">
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
                        <p class="text-xs text-slate-550 mt-1">Laporan diproses secara rahasia dan aman demi kenyamanan pelapor.</p>
                    </div>
                    <div class="p-6 border-t md:border-t-0 md:border-x border-slate-200">
                        <div class="text-3xl font-extrabold text-indigo-600">Responsif</div>
                        <div class="text-sm font-semibold text-slate-800 mt-2">Penanganan Cepat</div>
                        <p class="text-xs text-slate-555 mt-1">Setiap laporan yang masuk akan segera ditindaklanjuti oleh petugas sekolah.</p>
                    </div>
                    <div class="p-6 border-t md:border-t-0 border-slate-200">
                        <div class="text-3xl font-extrabold text-indigo-600">Transparan</div>
                        <div class="text-sm font-semibold text-slate-800 mt-2">Pantau Status</div>
                        <p class="text-xs text-slate-555 mt-1">Siswa dapat memantau perkembangan status laporan mereka secara real-time.</p>
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
                <div class="step-card bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative cursor-pointer">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 font-bold rounded-lg flex items-center justify-center mb-4">
                        1
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Masuk/Login</h4>
                    <p class="text-sm text-slate-600">Siswa masuk ke aplikasi dengan menggunakan NIS (Nomor Induk Siswa) dan password masing-masing.</p>
                </div>

                <!-- Step 2 -->
                <div class="step-card bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative cursor-pointer">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 font-bold rounded-lg flex items-center justify-center mb-4">
                        2
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Tulis Laporan</h4>
                    <p class="text-sm text-slate-600">Buat laporan baru dengan menulis judul, kategori masalah (bullying, dll), dan isi pengaduan lengkap.</p>
                </div>

                <!-- Step 3 -->
                <div class="step-card bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative cursor-pointer">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 font-bold rounded-lg flex items-center justify-center mb-4">
                        3
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Tinjauan Petugas</h4>
                    <p class="text-sm text-slate-600">Petugas sekolah akan memeriksa kebenaran laporan, memberikan tanggapan, dan memperbarui status.</p>
                </div>

                <!-- Step 4 -->
                <div class="step-card bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative cursor-pointer">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 font-bold rounded-lg flex items-center justify-center mb-4">
                        4
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Laporan Selesai</h4>
                    <p class="text-sm text-slate-600">Pantau proses pengaduan Anda langsung dari dashboard siswa sampai selesai ditangani.</p>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 border-t border-slate-200">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-slate-900">FAQ Keamanan & Pengaduan</h3>
                <p class="text-slate-500 mt-2">Menjawab pertanyaan umum dan keraguan sebelum Anda melapor</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                    <button onclick="toggleFaq(1)" class="faq-btn w-full flex justify-between items-center text-left text-sm font-extrabold text-slate-800 hover:text-indigo-600 transition-colors focus:outline-none cursor-pointer">
                        <span>Apakah kerahasiaan identitas saya benar-benar terjamin?</span>
                        <svg id="faq-icon-1" class="h-4 w-4 text-slate-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <p id="faq-answer-1" class="hidden text-xs text-slate-600 mt-3 leading-relaxed">
                        Ya, 100% rahasia. Hanya Admin Sistem dan Tim Guru Bimbingan Konseling (BK) yang memiliki akses untuk membuka berkas laporan Anda. Pihak terlapor atau teman sekelas Anda tidak akan pernah mengetahui identitas Anda tanpa persetujuan eksplisit untuk penanganan kasus hukum berat.
                    </p>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                    <button onclick="toggleFaq(2)" class="faq-btn w-full flex justify-between items-center text-left text-sm font-extrabold text-slate-800 hover:text-indigo-600 transition-colors focus:outline-none cursor-pointer">
                        <span>Berapa lama laporan saya akan ditindaklanjuti?</span>
                        <svg id="faq-icon-2" class="h-4 w-4 text-slate-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <p id="faq-answer-2" class="hidden text-xs text-slate-600 mt-3 leading-relaxed">
                        Semua laporan baru yang masuk akan ditinjau dalam waktu maksimal 2x24 jam kerja. Setelah proses pemeriksaan dimulai oleh Tim BK, status laporan Anda akan diperbarui menjadi "Diproses" di halaman dashboard Anda.
                    </p>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                    <button onclick="toggleFaq(3)" class="faq-btn w-full flex justify-between items-center text-left text-sm font-extrabold text-slate-800 hover:text-indigo-600 transition-colors focus:outline-none cursor-pointer">
                        <span>Apa yang harus saya lakukan jika mendapat ancaman setelah melapor?</span>
                        <svg id="faq-icon-3" class="h-4 w-4 text-slate-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <p id="faq-answer-3" class="hidden text-xs text-slate-600 mt-3 leading-relaxed">
                        Segera tuliskan ancaman tersebut dalam kronologi kejadian laporan Anda atau laporkan kembali secara darurat. Sekolah memiliki komitmen perlindungan fisik dan mental bagi pelapor. Setiap tindakan intimidasi lanjutan terhadap pelapor akan dikenakan sanksi disiplin berat.
                    </p>
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

    <!-- Back to Top Button -->
    <a href="#" id="back-to-top" class="fixed bottom-6 right-6 z-50 bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 opacity-0 invisible hover:scale-110 flex items-center justify-center cursor-pointer">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </a>

    <!-- Scroll & FAQ & Theme JavaScript -->
    <script>
        // Back to Top Button
        const backToTopButton = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });

        // FAQ Toggle
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

        // Dark Mode Logic
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');

        function enableDarkMode() {
            document.body.classList.add('dark-mode');
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
            localStorage.setItem('dark-mode', 'enabled');
        }

        function disableDarkMode() {
            document.body.classList.remove('dark-mode');
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
            localStorage.setItem('dark-mode', 'disabled');
        }

        darkModeToggle.addEventListener('click', () => {
            if (document.body.classList.contains('dark-mode')) {
                disableDarkMode();
            } else {
                enableDarkMode();
            }
        });

        // Initialize Theme on load
        if (localStorage.getItem('dark-mode') === 'enabled') {
            enableDarkMode();
        }
    </script>
</body>
</html>
