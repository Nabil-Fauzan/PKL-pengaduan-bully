<section id="tentang" class="section-py">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left: Device Mockup Showcase -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative p-2">
                    <!-- Browser / Device Window Frame -->
                    <div class="about-mockup-frame rounded-4 overflow-hidden shadow-lg border">
                        <div class="about-mockup-header py-2 px-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="rounded-circle d-inline-block" style="width: 10px; height: 10px; background: #ef4444;"></span>
                                <span class="rounded-circle d-inline-block" style="width: 10px; height: 10px; background: #f59e0b;"></span>
                                <span class="rounded-circle d-inline-block" style="width: 10px; height: 10px; background: #10b981;"></span>
                            </div>
                            <div class="about-mockup-address px-3 py-1 rounded-pill text-truncate" style="font-size: 0.72rem;">
                                <i class="fas fa-lock me-1 text-success-high"></i> stipor.infinityfreeapp.com/dashboard
                            </div>
                            <div style="width: 32px;"></div>
                        </div>
                        <div class="about-mockup-body position-relative bg-light">
                            <img src="{{ asset('assets/img/showcase/dashboard-preview.webp') }}" 
                                 onerror="this.onerror=null; this.src='{{ asset('assets/img/showcase/dashboard-preview.png') }}';" 
                                 alt="Tampilan Antarmuka Portal Siswa STIPOR" 
                                 class="img-fluid w-100 d-block about-mockup-img" 
                                 width="900" 
                                 height="560" 
                                 loading="lazy">
                        </div>
                    </div>

                    <!-- Caption Badge Below Mockup (Responsive & Non-intrusive) -->
                    <div class="text-center mt-3" data-aos="fade-up" data-aos-delay="150">
                        <span class="badge rounded-pill about-mockup-caption-badge">
                            <i class="fas fa-laptop-code flex-shrink-0"></i> <span>Antarmuka Portal Siswa (Responsif &amp; Mudah Diakses)</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right: Service Explanation & Feature Checklist -->
            <div class="col-lg-6" data-aos="fade-left">
                <span class="section-tag">TENTANG STIPOR</span>
                <h2 class="section-title">Solusi Nyata Perlindungan Hak Belajar Siswa</h2>
                <p class="text-muted mb-4" style="line-height: 1.75;">
                    Rasa takut dan ragu melapor sering kali menjadi penghalang terhentinya perundungan. STIPOR hadir memberikan ruang aman, didengar dengan empati, dan ditindaklanjuti secara profesional oleh Guru BK demi masa depan belajar yang damai.
                </p>

                <ul class="list-unstyled mb-4 d-flex flex-column gap-3 about-feature-list">
                    <li class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle text-success-high fs-5 mt-1 flex-shrink-0"></i>
                        <div>
                            <strong>Akses Langsung ke Ruang BK</strong>
                            <small class="d-block text-muted">Laporan terenkripsi dan langsung diterima Guru BK tanpa perantara pihak lain.</small>
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle text-success-high fs-5 mt-1 flex-shrink-0"></i>
                        <div>
                            <strong>Kerahasiaan Identitas 100%</strong>
                            <small class="d-block text-muted">Data pelapor dan saksi terlindungi penuh dari risiko intimidasi lanjutan.</small>
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle text-success-high fs-5 mt-1 flex-shrink-0"></i>
                        <div>
                            <strong>Transparansi Status Kasus</strong>
                            <small class="d-block text-muted">Pantau perkembangan tindak lanjut laporan langsung dari portal siswa secara real-time.</small>
                        </div>
                    </li>
                </ul>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="btn btn-stipor-primary">
                        <i class="fas fa-shield-alt me-1"></i> Masuk ke Portal Pengaduan
                    </a>
                    <a href="#komitmen" class="btn btn-stipor-outline px-4 py-2">
                        <i class="fas fa-user-tie me-1"></i> Komitmen Pimpinan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
