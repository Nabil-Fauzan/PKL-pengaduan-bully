<section id="faq" class="section-py bg-light">
    <div class="container">
        <div class="row g-5">
            <!-- Left: FAQ Accordion with Instant Search -->
            <div class="col-lg-7" data-aos="fade-right">
                <span class="section-tag">TANYA JAWAB (FAQ)</span>
                <h2 class="section-title mb-3">Pertanyaan yang Sering Diajukan</h2>
                <p class="text-muted mb-4 small">Temukan jawaban cepat seputar keamanan data, alur penanganan, peran saksi, dan akun siswa.</p>

                <!-- FAQ Search Box -->
                <div class="faq-search-wrapper mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="faqSearchInput" class="form-control border-start-0 ps-1" placeholder="Cari pertanyaan... (contoh: rahasia, waktu, saksi, bukti)" aria-label="Cari pertanyaan di FAQ">
                        <button class="btn btn-outline-secondary d-none border-start-0" type="button" id="faqSearchClear" aria-label="Bersihkan pencarian">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- FAQ Category Filter Chips -->
                <div class="faq-filter-chips d-flex flex-wrap gap-2 mb-4" id="faqCategoryChips">
                    <button type="button" class="faq-chip active" data-filter="all">Semua</button>
                    <button type="button" class="faq-chip" data-filter="kerahasiaan"><i class="fas fa-user-shield me-1"></i> Kerahasiaan</button>
                    <button type="button" class="faq-chip" data-filter="penanganan"><i class="fas fa-clock me-1"></i> Penanganan</button>
                    <button type="button" class="faq-chip" data-filter="saksi"><i class="fas fa-hands-helping me-1"></i> Saksi</button>
                    <button type="button" class="faq-chip" data-filter="akun"><i class="fas fa-key me-1"></i> Akun</button>
                </div>

                <!-- FAQ Match Status / Counter -->
                <div id="faqSearchResultCount" class="small text-muted mb-3 d-none">
                    <i class="fas fa-info-circle me-1 text-primary"></i> <span id="faqMatchText">Menampilkan hasil</span>
                </div>
                
                <!-- FAQ Accordion List -->
                <div class="accordion" id="stiporFaqAccordion">
                    <!-- Item 1: Kerahasiaan Identitas -->
                    <div class="accordion-item faq-item" data-category="kerahasiaan">
                        <h3 class="accordion-header" id="faqHeadingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                                Apakah identitas saya sebagai pelapor dijamin aman dan rahasia?
                            </button>
                        </h3>
                        <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                <strong>Ya, 100% aman dan rahasia.</strong> Laporan Anda hanya dapat diakses oleh Guru BK yang bertugas menangani kasus. Pelaku, siswa lain, maupun teman sekelas tidak akan pernah mengetahui siapa pembuat laporan.
                            </div>
                        </div>
                    </div>

                    <!-- Item 2: Waktu Penanganan -->
                    <div class="accordion-item faq-item" data-category="penanganan">
                        <h3 class="accordion-header" id="faqHeadingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                                Berapa lama laporan saya akan ditanggapi oleh Tim BK?
                            </button>
                        </h3>
                        <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                Setiap laporan yang masuk akan diverifikasi oleh Tim Bimbingan Konseling maksimal <strong>1x24 jam kerja</strong>. Anda dapat memantau status perkembangan (Menunggu, Diproses, Selesai) dan catatan tanggapan langsung di dashboard portal siswa Anda.
                            </div>
                        </div>
                    </div>

                    <!-- Item 3: Pelaporan oleh Saksi -->
                    <div class="accordion-item faq-item" data-category="saksi">
                        <h3 class="accordion-header" id="faqHeadingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                                Apakah saya boleh melaporkan kejadian yang menimpa teman saya (sebagai saksi)?
                            </button>
                        </h3>
                        <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                <strong>Sangat boleh dan dianjurkan!</strong> Sebagai saksi (upstander), kepedulian Anda dapat menyelamatkan teman Anda dari dampak buruk perundungan yang berkepanjangan. Identitas Anda sebagai saksi pelapor juga dilindungi dengan kerahasiaan penuh.
                            </div>
                        </div>
                    </div>

                    <!-- Item 4: Bukti Laporan -->
                    <div class="accordion-item faq-item" data-category="penanganan">
                        <h3 class="accordion-header" id="faqHeadingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                                Bukti apa saja yang dapat saya lampirkan dalam formulir pengaduan?
                            </button>
                        </h3>
                        <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                Anda dapat melampirkan file foto (JPG, PNG) seperti tangkapan layar (screenshot) percakapan di grup WhatsApp / media sosial, foto luka/kerusakan barang, atau dokumen pendukung lainnya maksimal berukuran 2MB.
                            </div>
                        </div>
                    </div>

                    <!-- Item 5: Di Luar Jam Sekolah -->
                    <div class="accordion-item faq-item" data-category="saksi kerahasiaan">
                        <h3 class="accordion-header" id="faqHeadingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFive" aria-expanded="false" aria-controls="faqCollapseFive">
                                Bagaimana jika perundungan terjadi di luar jam sekolah atau di dunia maya?
                            </button>
                        </h3>
                        <div id="faqCollapseFive" class="accordion-collapse collapse" aria-labelledby="faqHeadingFive" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                <strong>Tetap laporkan ke STIPOR.</strong> Segala bentuk perundungan, ancaman siber (cyberbullying), maupun teror di media sosial antarsiswa SMK TI Airlangga tetap berada dalam pengawasan dan tanggung jawab pembinaan etika sekolah.
                            </div>
                        </div>
                    </div>

                    <!-- Item 6: Lupa Password & Akun -->
                    <div class="accordion-item faq-item" data-category="akun">
                        <h3 class="accordion-header" id="faqHeadingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseSix" aria-expanded="false" aria-controls="faqCollapseSix">
                                Bagaimana jika saya lupa password akun siswa saya?
                            </button>
                        </h3>
                        <div id="faqCollapseSix" class="accordion-collapse collapse" aria-labelledby="faqHeadingSix" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                Anda dapat langsung datang ke Ruang BK di lantai 1 atau menghubungi Tim Administrator Sekolah untuk melakukan reset password akun dengan menunjukkan kartu pelajar aktif Anda.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State (When no results found) -->
                <div id="faqEmptyState" class="text-center py-5 d-none">
                    <div class="mb-3 text-muted">
                        <i class="fas fa-search-minus fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Pertanyaan Tidak Ditemukan</h5>
                    <p class="text-muted small mb-3">Coba gunakan kata kunci lain atau langsung tanyakan ke Ruang BK melalui kontak di sebelah kanan.</p>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="faqResetBtn">
                        <i class="fas fa-undo me-1"></i> Tampilkan Semua Pertanyaan
                    </button>
                </div>
            </div>

            <!-- Right: Contact Card -->
            <div class="col-lg-5" id="kontak" data-aos="fade-left">
                <span class="section-tag">KONTAK LANGSUNG</span>
                <h2 class="section-title mb-4">Ruang Bimbingan Konseling</h2>

                <div class="contact-info-card">
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="contact-icon-box">
                            <i class="fas fa-map-marker-alt fs-5"></i>
                        </div>
                        <div>
                            <h3 class="h6 fw-bold mb-1">Alamat Sekolah:</h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Jl. Pahlawan No. 2A, Kel. Dadi Mulya, Kec. Samarinda Ulu, Kota Samarinda, Kalimantan Timur 75123.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="contact-icon-box">
                            <i class="fas fa-clock fs-5"></i>
                        </div>
                        <div>
                            <h3 class="h6 fw-bold mb-1">Jam Konseling Tatap Muka:</h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Senin - Jumat: 07.30 - 15.30 WITA<br>
                                (Bisa langsung berkunjung di Ruang BK Lantai 1)
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="contact-icon-box success">
                            <i class="fas fa-phone-alt fs-5"></i>
                        </div>
                        <div>
                            <h3 class="h6 fw-bold mb-1">Hotline &amp; WhatsApp BK:</h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                (0541) 732644 / +62 812-3456-7890
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('login') }}" class="btn btn-stipor-primary w-100 py-2">
                        <i class="fas fa-bullhorn me-2"></i> Laporkan Masalah Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
