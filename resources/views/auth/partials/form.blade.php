        <!-- Global Errors -->
        @if ($errors->any())
            <div class="login-error-alert" role="alert">
                <svg class="login-error-icon" viewBox="0 0 20 20" fill="currentColor" width="18" height="18" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <div class="login-error-body">
                    <h2 class="login-error-title">Gagal Masuk:</h2>
                    <ul class="login-error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <!-- Hidden Role Input -->
            <input type="hidden" name="role" id="role-input" value="{{ $role }}">

            <!-- Siswa Input fields -->
            <div id="field-siswa" role="tabpanel" aria-labelledby="tab-siswa" class="form-group-item {{ $role === 'siswa' ? '' : 'hidden' }}">
                <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
                <div class="input-group-relative">
                    <div class="input-icon-left" aria-hidden="true">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                    </div>
                    <input type="text" name="nis" id="nis" value="{{ old('nis') }}" 
                        placeholder="Masukkan NIS Anda..." 
                        autocomplete="username"
                        inputmode="numeric"
                        aria-invalid="{{ $errors->has('nis') ? 'true' : 'false' }}"
                        class="input-box @error('nis') input-box-error @enderror">
                </div>
            </div>

            <!-- Petugas Input fields -->
            <div id="field-petugas" role="tabpanel" aria-labelledby="tab-petugas" class="form-group-item {{ $role === 'petugas' ? '' : 'hidden' }}">
                <label for="login_identifier" class="form-label">Username atau Email</label>
                <div class="input-group-relative">
                    <div class="input-icon-left" aria-hidden="true">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" name="login_identifier" id="login_identifier" value="{{ old('login_identifier') }}" 
                        placeholder="Masukkan username atau email..." 
                        autocomplete="username"
                        aria-invalid="{{ $errors->has('login_identifier') ? 'true' : 'false' }}"
                        class="input-box @error('login_identifier') input-box-error @enderror">
                </div>
            </div>

            <!-- Password (Shared) -->
            <div class="form-group-item">
                <label for="password" class="form-label">Password</label>
                <div class="input-group-relative">
                    <div class="input-icon-left" aria-hidden="true">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="password" id="password" 
                        placeholder="••••••••" 
                        autocomplete="current-password"
                        aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                        class="input-box has-password-toggle @error('password') input-box-error @enderror">
                    <button type="button" onclick="togglePasswordVisibility()" class="input-icon-right" title="Lihat / Sembunyikan Password" aria-label="Lihat atau sembunyikan password">
                        <!-- Open Eye Icon -->
                        <svg id="eye-open" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Closed Eye Icon (hidden by default) -->
                        <svg id="eye-closed" class="hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- reCAPTCHA Widget Container -->
            <div id="recaptcha-wrapper" class="form-group-item" style="display: flex; justify-content: center; min-height: 78px;" aria-label="Verifikasi reCAPTCHA">
                <div id="recaptcha-widget"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary-login form-group-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                Masuk ke Aplikasi
            </button>

            <!-- Back link -->
            <div style="text-align: center; padding-top: 0.25rem;">
                <a href="/" class="back-link">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="14" height="14" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </form>

        <!-- Trust Security Footer Badge -->
        <footer class="trust-badge-footer">
            <span class="trust-badge-text">
                <svg style="color: #16a34a;" fill="currentColor" viewBox="0 0 20 20" width="14" height="14" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
                Website Resmi &amp; Terlindungi Unit BK
            </span>
        </footer>
