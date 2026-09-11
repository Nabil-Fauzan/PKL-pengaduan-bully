<section id="kategori" class="section-py">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">KLASIFIKASI KASUS</span>
            <h2 class="section-title">Kenali Jenis Perundungan di Sekolah</h2>
            <p class="section-subtitle">Pilihlah kategori yang sesuai saat mengirimkan laporan pengaduan agar tim penanganan dapat mengambil tindakan yang tepat sasaran.</p>
        </div>

        <!-- Category Filter & Mobile Swipeable Indicator -->
        <div class="cat-filter-wrapper mb-4 text-center" data-aos="fade-up" data-aos-delay="50">
            <!-- Mobile Swipe Hint Badge -->
            <div class="cat-swipe-indicator-wrapper d-flex d-md-none align-items-center justify-content-center mb-3">
                <span class="badge rounded-pill cat-swipe-hint">
                    <i class="fas fa-arrows-alt-h me-1 text-primary"></i> Geser kartu atau pilih filter jenis kasus
                </span>
            </div>

            <!-- Filter Chips Group (Horizontal Scrollable on Mobile) -->
            <div class="cat-filter-scroll-container d-inline-flex gap-2 p-1 rounded-pill">
                <button type="button" class="btn cat-filter-chip active" data-cat-filter="all" aria-label="Tampilkan Semua Kategori">
                    <i class="fas fa-th-large me-1"></i> Semua Jenis
                </button>
                <button type="button" class="btn cat-filter-chip" data-cat-filter="fisik" aria-label="Filter Kategori Fisik">
                    <i class="fas fa-fist-raised me-1 text-danger"></i> Fisik
                </button>
                <button type="button" class="btn cat-filter-chip" data-cat-filter="verbal" aria-label="Filter Kategori Verbal dan Emosional">
                    <i class="fas fa-comments me-1 text-warning"></i> Verbal
                </button>
                <button type="button" class="btn cat-filter-chip" data-cat-filter="cyber" aria-label="Filter Kategori Cyberbullying">
                    <i class="fas fa-mobile-alt me-1 text-primary"></i> Cyberbullying
                </button>
                <button type="button" class="btn cat-filter-chip" data-cat-filter="fasilitas" aria-label="Filter Kategori Fasilitas Sekolah">
                    <i class="fas fa-school me-1 text-purple"></i> Fasilitas
                </button>
            </div>
        </div>

        <div class="row g-4 justify-content-center cat-scroll-row" id="categoryCardsRow">
            <!-- Card 1: Bullying Fisik -->
            <div class="col-12 col-sm-6 col-lg-3 category-col-item" data-cat-type="fisik" data-aos="fade-up" data-aos-delay="100">
                <div class="category-card h-100 d-flex flex-column">
                    <div class="category-icon cat-danger">
                        <i class="fas fa-fist-raised"></i>
                    </div>
                    <span class="category-tag tag-danger">Fisik</span>
                    <h3 class="h5 fw-bold mb-2">Perundungan Fisik</h3>
                    <p class="text-muted mb-3" style="font-size: 0.88rem; line-height: 1.6;">
                        Kekerasan kontak tubuh, pemalakan paksa, atau perusakan barang pribadi siswa secara sengaja.
                    </p>
                    <div class="mt-auto pt-2 border-top">
                        <span class="badge rounded-pill cat-example-chip cat-chip-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Contoh: Memukul, mendorong, merampas uang jajan, merusak seragam/alat tulis.">
                            <i class="fas fa-info-circle me-1"></i> Contoh Kasus
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card 2: Bullying Verbal & Sosial -->
            <div class="col-12 col-sm-6 col-lg-3 category-col-item" data-cat-type="verbal" data-aos="fade-up" data-aos-delay="200">
                <div class="category-card h-100 d-flex flex-column">
                    <div class="category-icon cat-warning">
                        <i class="fas fa-comments"></i>
                    </div>
                    <span class="category-tag tag-warning">Verbal &amp; Relasional</span>
                    <h3 class="h5 fw-bold mb-2">Verbal &amp; Emosional</h3>
                    <p class="text-muted mb-3" style="font-size: 0.88rem; line-height: 1.6;">
                        Ejekan fisik (<em>body shaming</em>), hinaan martabat, ancaman, atau pengucilan dari pergaulan kelas.
                    </p>
                    <div class="mt-auto pt-2 border-top">
                        <span class="badge rounded-pill cat-example-chip cat-chip-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Contoh: Hinaan fisik, mencemooh nama orang tua, fitnah, mengucilkan teman saat kerja kelompok.">
                            <i class="fas fa-info-circle me-1"></i> Contoh Kasus
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card 3: Cyberbullying -->
            <div class="col-12 col-sm-6 col-lg-3 category-col-item" data-cat-type="cyber" data-aos="fade-up" data-aos-delay="300">
                <div class="category-card h-100 d-flex flex-column">
                    <div class="category-icon cat-primary">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <span class="category-tag tag-primary">Daring / Medsos</span>
                    <h3 class="h5 fw-bold mb-2">Cyberbullying</h3>
                    <p class="text-muted mb-3" style="font-size: 0.88rem; line-height: 1.6;">
                        Teror pesan media sosial, penyebaran fitnah/foto tanpa izin, hingga pencemaran nama baik digital.
                    </p>
                    <div class="mt-auto pt-2 border-top">
                        <span class="badge rounded-pill cat-example-chip cat-chip-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Contoh: Teror di grup WhatsApp kelas, membuat akun palsu untuk memfitnah, menyebar foto memalukan.">
                            <i class="fas fa-info-circle me-1"></i> Contoh Kasus
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card 4: Fasilitas & Lainnya -->
            <div class="col-12 col-sm-6 col-lg-3 category-col-item" data-cat-type="fasilitas" data-aos="fade-up" data-aos-delay="400">
                <div class="category-card h-100 d-flex flex-column">
                    <div class="category-icon cat-purple">
                        <i class="fas fa-school"></i>
                    </div>
                    <span class="category-tag tag-purple">Fasilitas &amp; Akademik</span>
                    <h3 class="h5 fw-bold mb-2">Fasilitas Sekolah</h3>
                    <p class="text-muted mb-3" style="font-size: 0.88rem; line-height: 1.6;">
                        Vandalisme sarana sekolah, perundungan tugas belajar, atau pemerasan bermodus akademik.
                    </p>
                    <div class="mt-auto pt-2 border-top">
                        <span class="badge rounded-pill cat-example-chip cat-chip-purple" data-bs-toggle="tooltip" data-bs-placement="top" title="Contoh: Mencoret meja/loker teman, menyembunyikan buku pelajaran, memeras tugas di lab komputer.">
                            <i class="fas fa-info-circle me-1"></i> Contoh Kasus
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
