<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STIPOR - Layanan Pengaduan Bullying SMK TI Airlangga Samarinda</title>
    <meta name="description" content="Sistem Informasi Pelaporan Bullying dan Pengaduan Siswa Resmi SMK TI Airlangga Samarinda. 100% Rahasia, Cepat, dan Didampingi Guru BK Profesional.">

    <!-- OpenGraph & Social Media Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="STIPOR - Layanan Pengaduan &amp; Perlindungan Bullying SMK TI Airlangga">
    <meta property="og:description" content="Website resmi pelaporan bullying SMK TI Airlangga Samarinda. 100% Rahasia, Aman, Bebas Intimidasi, dan Didampingi Guru BK Profesional.">
    <meta property="og:image" content="{{ asset('favicon.svg') }}">
    <meta property="og:site_name" content="STIPOR SMK TI Airlangga">
    <meta property="og:locale" content="id_ID">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="STIPOR - Layanan Pengaduan Bullying SMK TI Airlangga">
    <meta name="twitter:description" content="Laporkan tindakan perundungan secara aman &amp; rahasia. Bersama wujudkan sekolah ramah dan beradab.">
    <meta name="twitter:image" content="{{ asset('favicon.svg') }}">
    <meta name="theme-color" content="#2563eb">

    <!-- SEO & Agentic Browsing Metadata -->
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Structured Data (Schema.org JSON-LD) -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "WebSite",
        "name": "STIPOR SMK TI Airlangga",
        "url": "{{ url('/') }}",
        "description": "Sistem Informasi Pelaporan Bullying dan Pengaduan Siswa Resmi SMK TI Airlangga Samarinda. 100% Rahasia, Cepat, dan Didampingi Guru BK Profesional.",
        "publisher": {
            "@@type": "EducationalOrganization",
            "name": "SMK TI Airlangga Samarinda",
            "url": "https://smktiairlangga.sch.id"
        }
    }
    </script>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Preload Hero LCP Images -->
    <link rel="preload" as="image" href="{{ asset('assets/img/hero-carousel/slide-1-mobile.webp') }}" type="image/webp" media="(max-width: 576px)" fetchpriority="high">
    <link rel="preload" as="image" href="{{ asset('assets/img/hero-carousel/slide-1.webp') }}" type="image/webp" media="(min-width: 576.02px)" fetchpriority="high">

    <!-- Bootstrap 5.3.3 CSS (Local Zero-Latency) -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">

    <!-- Custom Landing Page Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">

    <!-- Local Typography (Plus Jakarta Sans & Poppins - Zero Latency Non-Blocking) -->
    <link rel="preload" as="style" href="{{ asset('assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}"></noscript>

    <!-- Font Awesome 5 (Local Zero-Latency Non-Blocking) -->
    <link rel="preload" as="style" href="{{ asset('assets/vendor/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/all.min.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/all.min.css') }}"></noscript>

    <!-- AOS CSS (Local Zero-Latency Non-Blocking) -->
    <link rel="preload" as="style" href="{{ asset('assets/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}"></noscript>

    <!-- Instant Dark Mode Init Script (Prevents FOUC) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('stipor_theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-bs-theme', 'light');
            }
        })();
    </script>
</head>
<body id="beranda">

    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="visually-hidden-focusable btn btn-primary position-absolute top-0 start-0 m-2" style="z-index: 9999;">Lewati ke konten utama</a>

    <!-- 1. STICKY NAVBAR -->
    @include('landing.partials.navbar')

    <!-- MAIN LANDMARK (Accessibility) -->
    <main id="main-content">
        <!-- 3. HERO SECTION -->
        @include('landing.partials.hero')

        <!-- 4. STATS & VALUE HIGHLIGHT BAR -->
        @include('landing.partials.stats')

        <!-- 5. TENTANG LAYANAN (ABOUT) -->
        @include('landing.partials.about')

        <!-- 5.1 KOMITMEN PIMPINAN & GURU BK (QUOTES) -->
        @include('landing.partials.quotes')

        <!-- 6. KATEGORI PERUNDUNGAN (MENU/CATEGORY CARDS) -->
        @include('landing.partials.categories')

        <!-- 6.1 CEK MANDIRI INTERAKTIF (QUIZ) -->
        @include('landing.partials.quiz')

        <!-- 6.2 PANDUAN AKSI UNTUK SAKSI (METODE 5D) -->
        @include('landing.partials.bystander_guide')

        <!-- 7. ALUR PENANGANAN (PROCESS STEPS) -->
        @include('landing.partials.process')

        <!-- 8. SECTION FAQ & KONTAK RUANG BK -->
        @include('landing.partials.faq_contact')
    </main>

    <!-- 9. FOOTER PROFESIONAL -->
    @include('landing.partials.footer')

    <!-- Back to Top Floating Button -->
    <a href="#beranda" id="backToTop" class="back-to-top-btn" aria-label="Kembali ke atas" title="Kembali ke atas">
        <i class="fas fa-chevron-up"></i>
    </a>

    <!-- Bootstrap 5.3.3 JS Bundle (Local Zero-Latency Defer) -->
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}" defer></script>

    <!-- AOS JS (Local Zero-Latency Defer) -->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}" defer></script>

    <!-- Custom Landing Page Interactive Script -->
    <script src="{{ asset('assets/js/landing.js') }}" defer></script>
</body>
</html>
