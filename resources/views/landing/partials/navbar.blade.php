<nav class="navbar navbar-expand-lg navbar-stipor sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <div class="rounded-3 bg-primary text-white d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                <i class="fas fa-shield-alt fs-5"></i>
            </div>
            <div>
                <span class="fw-bold text-dark d-block leading-tight">STIPOR</span>
                <small class="text-muted d-block" style="font-size: 0.72rem; font-weight: 500;">SMK TI AIRLANGGA</small>
            </div>
        </a>

        <div class="d-flex align-items-center gap-2">
            <!-- Theme Mode Toggle -->
            <button id="themeToggle" class="btn btn-theme-toggle" type="button" aria-label="Ganti mode gelap / terang" title="Ganti Mode Gelap / Terang">
                <i id="themeIcon" class="fas fa-moon"></i>
            </button>

            <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStiporNav" aria-controls="navbarStiporNav" aria-expanded="false" aria-label="Buka navigasi menu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarStiporNav">
            <ul class="navbar-nav mx-auto mb-3 mb-lg-0 text-center text-lg-start">
                <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#kategori">Kategori Kasus</a></li>
                <li class="nav-item"><a class="nav-link" href="#cek-mandiri">Cek Mandiri</a></li>
                <li class="nav-item"><a class="nav-link" href="#alur">Alur Laporan</a></li>
                <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
            </ul>

            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-center gap-2 mt-2 mt-lg-0">
                @if(Auth::guard('siswa')->check())
                    <a href="{{ route('dashboard') }}" class="btn btn-stipor-primary text-center">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard Siswa
                    </a>
                @elseif(Auth::guard('web')->check())
                    <a href="{{ route('dashboard') }}" class="btn btn-stipor-primary text-center">
                        <i class="fas fa-tachometer-alt me-1"></i> Panel Petugas
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-stipor-outline text-center">
                        <i class="fas fa-sign-in-alt me-1"></i> Masuk
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-stipor-primary text-center">
                        <i class="fas fa-bullhorn me-1"></i> Laporkan Sekarang
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
