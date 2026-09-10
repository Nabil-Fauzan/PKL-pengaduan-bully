<section class="hero-carousel-section" id="beranda-hero">
    <div id="stiporHeroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        
        <!-- Carousel Indicators -->
        <div class="carousel-indicators hero-carousel-indicators mb-3">
            <button type="button" data-bs-target="#stiporHeroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#stiporHeroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#stiporHeroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Carousel Slides -->
        <div class="carousel-inner">

            <!-- Slide 1: Komitmen Sekolah & Buat Pengaduan -->
            <div class="carousel-item active">
                <picture>
                    <source srcset="{{ asset('assets/img/hero-carousel/slide-1-mobile.webp') }}" media="(max-width: 576px)" type="image/webp" width="640" height="360">
                    <img src="{{ asset('assets/img/hero-carousel/slide-1.webp') }}" class="hero-carousel-img" alt="STIPOR SMK TI Airlangga - Bebas Bullying" width="1920" height="1080" fetchpriority="high" decoding="async">
                </picture>
                <div class="hero-carousel-overlay"></div>
                <div class="container h-100">
                    <div class="hero-carousel-content">
                        <span class="hero-carousel-badge" data-aos="fade-down">
                            <i class="fas fa-shield-alt"></i> Sistem Resmi Pengaduan Sekolah
                        </span>
                        <h1 class="hero-carousel-title" data-aos="fade-up" data-aos-delay="100">
                            Wujudkan Sekolah <span>Aman, Nyaman</span> &amp; Bebas Perundungan
                        </h1>
                        <p class="hero-carousel-desc" data-aos="fade-up" data-aos-delay="200">
                            Layanan pelaporan resmi SMK TI Airlangga. 100% rahasia, aman, dan didampingi langsung oleh Guru BK.
                        </p>
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3" data-aos="fade-up" data-aos-delay="300">
                            <a href="{{ route('login') }}" class="btn btn-stipor-primary text-center px-4 py-2">
                                <i class="fas fa-paper-plane me-2"></i> Buat Pengaduan Sekarang
                            </a>
                            <a href="#alur" class="btn btn-outline-light rounded-pill text-center px-4 py-2">
                                <i class="fas fa-info-circle me-2"></i> Pelajari Alur Kasus
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Kerahasiaan 100% & Keamanan Data -->
            <div class="carousel-item">
                <picture>
                    <source srcset="{{ asset('assets/img/hero-carousel/slide-2-mobile.webp') }}" media="(max-width: 576px)" type="image/webp" width="640" height="360">
                    <img src="{{ asset('assets/img/hero-carousel/slide-2.webp') }}" class="hero-carousel-img" alt="Kerahasiaan 100% Terjamin Unit BK" width="1920" height="1080" loading="lazy" decoding="async">
                </picture>
                <div class="hero-carousel-overlay"></div>
                <div class="container h-100">
                    <div class="hero-carousel-content">
                        <span class="hero-carousel-badge">
                            <i class="fas fa-user-shield"></i> 100% Kerahasiaan Terjamin
                        </span>
                        <h2 class="hero-carousel-title">
                            Privasi Terjaga, <span>Tanpa Rasa Takut</span>
                        </h2>
                        <p class="hero-carousel-desc">
                            Identitas pelapor dan saksi terlindungi penuh langsung di meja Bimbingan Konseling tanpa perantara.
                        </p>
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3">
                            <a href="{{ route('login') }}" class="btn btn-stipor-primary text-center px-4 py-2">
                                <i class="fas fa-bullhorn me-2"></i> Laporkan Masalah
                            </a>
                            <a href="#faq" class="btn btn-outline-light rounded-pill text-center px-4 py-2">
                                <i class="fas fa-question-circle me-2"></i> Tanya Jawab Kerahasiaan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Pendampingan Guru BK & Aksi Saksi (5D) -->
            <div class="carousel-item">
                <picture>
                    <source srcset="{{ asset('assets/img/hero-carousel/slide-3-mobile.webp') }}" media="(max-width: 576px)" type="image/webp" width="640" height="360">
                    <img src="{{ asset('assets/img/hero-carousel/slide-3.webp') }}" class="hero-carousel-img" alt="Pendampingan Guru BK dan Panduan Saksi" width="1920" height="1080" loading="lazy" decoding="async">
                </picture>
                <div class="hero-carousel-overlay"></div>
                <div class="container h-100">
                    <div class="hero-carousel-content">
                        <span class="hero-carousel-badge">
                            <i class="fas fa-hands-helping"></i> Peduli Teman &amp; Upstander
                        </span>
                        <h2 class="hero-carousel-title">
                            Melihat Bullying? <span>Jadilah Pembela (Upstander)</span>
                        </h2>
                        <p class="hero-carousel-desc">
                            Gunakan metode 5D untuk lindungi temanmu atau ikuti kuis cek mandiri untuk menganalisis situasi.
                        </p>
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3">
                            <a href="#panduan-saksi" class="btn btn-stipor-primary text-center px-4 py-2">
                                <i class="fas fa-hands-helping me-2"></i> Panduan Saksi (5D)
                            </a>
                            <a href="#cek-mandiri" class="btn btn-outline-light rounded-pill text-center px-4 py-2">
                                <i class="fas fa-clipboard-check me-2"></i> Kuis Cek Mandiri
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Carousel Navigation Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#stiporHeroCarousel" data-bs-slide="prev" aria-label="Slide Sebelumnya">
            <span class="hero-carousel-control">
                <i class="fas fa-chevron-left" aria-hidden="true"></i>
            </span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#stiporHeroCarousel" data-bs-slide="next" aria-label="Slide Selanjutnya">
            <span class="hero-carousel-control">
                <i class="fas fa-chevron-right" aria-hidden="true"></i>
            </span>
        </button>

    </div>
</section>
