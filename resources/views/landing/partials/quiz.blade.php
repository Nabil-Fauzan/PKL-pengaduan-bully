<section id="cek-mandiri" class="section-py bg-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">CEK MANDIRI INTERAKTIF</span>
            <h2 class="section-title">Apakah yang Kamu Alami Termasuk Bullying?</h2>
            <p class="section-subtitle">Jawab 3 pertanyaan singkat di bawah ini untuk membantu mengenali situasi yang sedang kamu atau temanmu hadapi.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="zoom-in" data-aos-duration="800">
                <div class="quiz-card p-4 p-md-5 rounded-4 shadow-sm border">
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span id="quizStepText" class="text-primary-high fw-bold" style="font-size: 0.85rem;">Pertanyaan 1 dari 3</span>
                            <span id="quizPercentText" class="text-muted fw-semibold" style="font-size: 0.85rem;">33% Selesai</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 10px;">
                            <div id="quizProgressBar" class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" aria-label="Progres Kuis Analisis Bullying"></div>
                        </div>
                    </div>

                    <!-- Question Container -->
                    <div id="quizQuestionsContainer">
                        <!-- Q1 -->
                        <div class="quiz-step" id="quizStep1">
                            <h3 class="h5 fw-bold mb-3">1. Apakah perlakuan tidak menyenangkan tersebut terjadi berulang-ulang atau ada ancaman akan diulang?</h3>
                            <div class="d-flex flex-column gap-2 mt-3">
                                <button type="button" class="btn quiz-option-btn text-start p-3 d-flex align-items-center gap-3" onclick="selectQuizAnswer(1, 2, this)">
                                    <span class="quiz-radio-circle flex-shrink-0"><i class="fas fa-circle"></i></span>
                                    <span><strong>Ya, sering terjadi</strong> atau hampir setiap hari.</span>
                                </button>
                                <button type="button" class="btn quiz-option-btn text-start p-3 d-flex align-items-center gap-3" onclick="selectQuizAnswer(1, 1, this)">
                                    <span class="quiz-radio-circle flex-shrink-0"><i class="fas fa-circle"></i></span>
                                    <span><strong>Pernah beberapa kali</strong>, dan ada rasa khawatir terulang.</span>
                                </button>
                                <button type="button" class="btn quiz-option-btn text-start p-3 d-flex align-items-center gap-3" onclick="selectQuizAnswer(1, 0, this)">
                                    <span class="quiz-radio-circle flex-shrink-0"><i class="fas fa-circle"></i></span>
                                    <span><strong>Hanya sekali</strong> karena perdebatan/kesalahpahaman biasa.</span>
                                </button>
                            </div>
                        </div>

                        <!-- Q2 -->
                        <div class="quiz-step d-none" id="quizStep2">
                            <h3 class="h5 fw-bold mb-3">2. Apakah terdapat ketimpangan kuasa (misal: senior ke junior, kelompok mengeroyok individu, atau ancaman sosial/fisik)?</h3>
                            <div class="d-flex flex-column gap-2 mt-3">
                                <button type="button" class="btn quiz-option-btn text-start p-3 d-flex align-items-center gap-3" onclick="selectQuizAnswer(2, 2, this)">
                                    <span class="quiz-radio-circle flex-shrink-0"><i class="fas fa-circle"></i></span>
                                    <span><strong>Ya, sangat timpang</strong> (korban merasa tidak berdaya untuk melawan).</span>
                                </button>
                                <button type="button" class="btn quiz-option-btn text-start p-3 d-flex align-items-center gap-3" onclick="selectQuizAnswer(2, 1, this)">
                                    <span class="quiz-radio-circle flex-shrink-0"><i class="fas fa-circle"></i></span>
                                    <span><strong>Ada tekanan sosial/kelompok</strong> yang membuat merasa terasing.</span>
                                </button>
                                <button type="button" class="btn quiz-option-btn text-start p-3 d-flex align-items-center gap-3" onclick="selectQuizAnswer(2, 0, this)">
                                    <span class="quiz-radio-circle flex-shrink-0"><i class="fas fa-circle"></i></span>
                                    <span><strong>Setara</strong>, kami berteman akrab dan saling bercanda.</span>
                                </button>
                            </div>
                            <div class="d-flex justify-content-start mt-3 pt-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary quiz-prev-btn rounded-pill px-3 py-1" onclick="prevQuizStep(2)" aria-label="Kembali ke pertanyaan nomor 1">
                                    <i class="fas fa-arrow-left me-1"></i> Pertanyaan Sebelumnya
                                </button>
                            </div>
                        </div>

                        <!-- Q3 -->
                        <div class="quiz-step d-none" id="quizStep3">
                            <h3 class="h5 fw-bold mb-3">3. Bagaimana dampaknya terhadap perasaan dan kegiatan belajarmu di sekolah?</h3>
                            <div class="d-flex flex-column gap-2 mt-3">
                                <button type="button" class="btn quiz-option-btn text-start p-3 d-flex align-items-center gap-3" onclick="selectQuizAnswer(3, 2, this)">
                                    <span class="quiz-radio-circle flex-shrink-0"><i class="fas fa-circle"></i></span>
                                    <span><strong>Sangat tertekan / takut</strong> berangkat ke sekolah atau masuk kelas.</span>
                                </button>
                                <button type="button" class="btn quiz-option-btn text-start p-3 d-flex align-items-center gap-3" onclick="selectQuizAnswer(3, 1, this)">
                                    <span class="quiz-radio-circle flex-shrink-0"><i class="fas fa-circle"></i></span>
                                    <span><strong>Merasa cemas &amp; sedih</strong>, konsentrasi belajar menjadi terganggu.</span>
                                </button>
                                <button type="button" class="btn quiz-option-btn text-start p-3 d-flex align-items-center gap-3" onclick="selectQuizAnswer(3, 0, this)">
                                    <span class="quiz-radio-circle flex-shrink-0"><i class="fas fa-circle"></i></span>
                                    <span><strong>Tidak terlalu berdampak</strong>, masih merasa aman beraktivitas.</span>
                                </button>
                            </div>
                            <div class="d-flex justify-content-start mt-3 pt-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary quiz-prev-btn rounded-pill px-3 py-1" onclick="prevQuizStep(3)" aria-label="Kembali ke pertanyaan nomor 2">
                                    <i class="fas fa-arrow-left me-1"></i> Pertanyaan Sebelumnya
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Result Container -->
                    <div id="quizResultContainer" class="d-none text-center py-3">
                        <div id="quizResultIconBox" class="mb-3"></div>
                        <h3 id="quizResultTitle" class="h4 fw-bold mb-2"></h3>
                        <p id="quizResultDesc" class="text-muted mx-auto mb-4" style="max-width: 540px;"></p>
                        
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a id="quizActionBtn" href="{{ route('login') }}" class="btn btn-stipor-primary px-4 py-2">
                                <i class="fas fa-paper-plane me-1"></i> Buat Laporan Pengaduan
                            </a>
                            <button type="button" class="btn btn-stipor-outline px-4 py-2" onclick="resetQuiz()">
                                <i class="fas fa-redo-alt me-1"></i> Ulangi Cek
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
