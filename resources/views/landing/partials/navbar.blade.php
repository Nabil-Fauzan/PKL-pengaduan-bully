<nav class="navbar navbar-expand-lg navbar-stipor sticky-top">
    <div class="container-xl">
        <!-- Brand Logo & School Identity -->
        <a class="navbar-brand d-flex align-items-center gap-3 text-decoration-none me-3 me-xl-4" href="{{ url('/') }}">
            <div class="brand-logo-icon flex-shrink-0">
                <i class="fas fa-shield-alt fs-5"></i>
            </div>
            <div class="brand-text-group">
                <span class="brand-title d-block lh-1">STIPOR</span>
                <small class="brand-subtitle d-block mt-1">SMK TI AIRLANGGA</small>
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
            <ul class="navbar-nav mx-auto my-3 my-lg-0 text-center text-lg-start align-items-lg-center gap-1 gap-xl-2">
                <li class="nav-item"><a class="nav-link nav-link-stipor" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link nav-link-stipor" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link nav-link-stipor" href="#kategori">Kategori</a></li>

                <!-- Dropdown Menu Edukasi & Bantuan -->
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-stipor dropdown-toggle d-inline-flex align-items-center gap-1" href="#" id="navbarEdukasiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-label="Menu Edukasi dan Bantuan">
                        <span>Edukasi</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-stipor shadow-lg border-0" aria-labelledby="navbarEdukasiDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3" href="#panduan-saksi">
                                <div class="rounded-3 bg-warning bg-opacity-10 text-warning-high d-flex align-items-center justify-content-center p-2" style="width: 36px; height: 36px;">
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
                                <div class="rounded-3 bg-success bg-opacity-10 text-success-high d-flex align-items-center justify-content-center p-2" style="width: 36px; height: 36px;">
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

                <li class="nav-item"><a class="nav-link nav-link-stipor" href="#alur">Alur</a></li>
                <li class="nav-item"><a class="nav-link nav-link-stipor" href="#faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link nav-link-stipor" href="#kontak">Kontak</a></li>
            </ul>

            <!-- Desktop Action Group (Theme Toggle + CTA Buttons) -->
            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-center gap-3 mt-3 mt-lg-0 navbar-action-cluster ms-lg-3">
                <button class="btn btn-theme-toggle theme-toggle-btn d-none d-lg-inline-flex flex-shrink-0" type="button" aria-label="Ganti mode gelap / terang" title="Ganti Mode Gelap / Terang">
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
