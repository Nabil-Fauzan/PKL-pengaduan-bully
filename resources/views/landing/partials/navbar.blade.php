<nav class="navbar navbar-expand-lg navbar-stipor sticky-top">
    <div class="container">
        <!-- Brand Logo & School Identity -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <div class="rounded-3 bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;">
                <i class="fas fa-shield-alt fs-5"></i>
            </div>
            <div>
                <span class="fw-bold text-dark d-block lh-1">STIPOR</span>
                <small class="text-muted d-block mt-1" style="font-size: 0.72rem; font-weight: 600; letter-spacing: 0.04em;">SMK TI AIRLANGGA</small>
            </div>
        </a>

        <!-- Mobile Controls: Theme Toggle & Hamburger Toggler -->
        <div class="d-flex d-lg-none align-items-center gap-2">
            <button class="btn btn-theme-toggle theme-toggle-btn" type="button" aria-label="Ganti mode gelap / terang" title="Ganti Mode Gelap / Terang">
                <i class="fas fa-moon theme-icon"></i>
            </button>

            <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStiporNav" aria-controls="navbarStiporNav" aria-expanded="false" aria-label="Buka navigasi menu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Collapsible Menu -->
        <div class="collapse navbar-collapse" id="navbarStiporNav">
            <ul class="navbar-nav mx-auto mb-3 mb-lg-0 text-center text-lg-start align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#kategori">Kategori</a></li>

                <!-- Dropdown Menu Edukasi & Bantuan -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarEdukasiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Edukasi
                    </a>
                    <ul class="dropdown-menu dropdown-menu-stipor shadow-sm border-0" aria-labelledby="navbarEdukasiDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3" href="#edukasi">
                                <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center p-2" style="width: 34px; height: 34px;">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-semibold" style="font-size: 0.88rem;">Bentuk Bullying</span>
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Kenali tanda terselubung</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3" href="#panduan-saksi">
                                <div class="rounded-3 bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center p-2" style="width: 34px; height: 34px;">
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-semibold" style="font-size: 0.88rem;">Panduan Saksi</span>
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Aksi Upstander Metode 5D</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3" href="#cek-mandiri">
                                <div class="rounded-3 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center p-2" style="width: 34px; height: 34px;">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-semibold" style="font-size: 0.88rem;">Cek Mandiri</span>
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Quiz analisis situasi</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link" href="#alur">Alur</a></li>
                <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
            </ul>

            <!-- Desktop Action Group (Theme Toggle + CTA Buttons) -->
            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-center gap-2 mt-2 mt-lg-0">
                <button class="btn btn-theme-toggle theme-toggle-btn d-none d-lg-inline-flex me-1" type="button" aria-label="Ganti mode gelap / terang" title="Ganti Mode Gelap / Terang">
                    <i class="fas fa-moon theme-icon"></i>
                </button>

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
