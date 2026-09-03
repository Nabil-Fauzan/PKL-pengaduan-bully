<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tulis Pengaduan Baru | Lapor! Bullying</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        /* Dark Mode styles */
        body.dark-mode {
            background-color: #0f172a !important; /* Slate 900 */
            color: #f8fafc !important; /* Slate 50 */
        }
        .dark-mode .bg-white {
            background-color: #1e293b !important; /* Slate 800 */
            border-color: #334155 !important; /* Slate 700 */
            color: #f8fafc !important;
        }
        .dark-mode .text-slate-900,
        .dark-mode .text-slate-800 {
            color: #f8fafc !important;
        }
        .dark-mode .text-slate-500,
        .dark-mode .text-slate-400 {
            color: #94a3b8 !important; /* Slate 400 */
        }
        .dark-mode .border-slate-200,
        .dark-mode .border-slate-350,
        .dark-mode .border-slate-300 {
            border-color: #334155 !important;
        }
        .dark-mode input,
        .dark-mode select,
        .dark-mode textarea {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #f8fafc !important;
        }
        .dark-mode select option {
            background-color: #1e293b !important;
            color: #f8fafc !important;
        }
        /* Warning Notice Card in dark mode */
        .dark-mode .bg-amber-50 {
            background-color: rgba(245, 158, 11, 0.1) !important;
            border-color: rgba(245, 158, 11, 0.2) !important;
        }
        .dark-mode .text-amber-800 {
            color: #fef08a !important; /* light yellow */
        }
        .dark-mode .text-amber-900 {
            color: #fef9c3 !important;
        }
        /* Cancel button bg */
        .dark-mode .bg-white.text-slate-700,
        .dark-mode .bg-white {
            background-color: #1e293b !important;
            color: #f8fafc !important;
        }
    </style>

    <!-- Immediate Theme Initialization to avoid white flash -->
    <script>
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.documentElement.classList.add('dark');
            document.addEventListener('DOMContentLoaded', () => {
                document.body.classList.add('dark-mode');
            });
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen p-4 sm:p-6 md:p-8 flex items-center justify-center">

    <div class="max-w-xl w-full bg-white border border-slate-200 rounded-xl shadow-sm p-6 sm:p-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900">Tulis Pengaduan Baru</h1>
            <p class="text-sm text-slate-500 mt-1">Sampaikan keluhan atau laporan Anda secara rahasia dan aman</p>
        </div>

        <!-- Warning Notice Card -->
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6 text-xs text-amber-800 leading-relaxed font-medium flex gap-3">
            <svg class="h-5 w-5 text-amber-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <strong class="font-extrabold text-amber-900 text-[13px] block mb-1">PENTING: Laporan Tidak Dapat Diubah/Dihapus!</strong>
                Demi keadilan dan efisiensi penanganan, laporan yang telah Anda kirimkan <span class="font-extrabold text-amber-900">tidak dapat diubah atau ditarik kembali</span>. Pastikan Anda menuliskan fakta yang sebenar-benarnya. Laporan palsu, main-main, atau iseng akan dikenakan sanksi disiplin sekolah.
            </div>
        </div>

        <!-- Global Errors -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-100 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-red-800">Ada kesalahan pengisian data:</h3>
                        <ul class="text-xs text-red-700 list-disc list-inside mt-1 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('dashboard.pengaduan.simpan') }}" method="POST">
            @csrf

            <!-- Judul Pengaduan -->
            <div class="mb-5">
                <label for="judul" class="block text-sm font-semibold text-slate-800 mb-2">Judul Laporan</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                    placeholder="Contoh: Perundungan verbal di kantin sekolah..."
                    class="block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-slate-400">
                @error('judul')
                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-5">
                <label for="kategori" class="block text-sm font-semibold text-slate-800 mb-2">Kategori Laporan</label>
                <select name="kategori" id="kategori" 
                    class="block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="bullying" {{ old('kategori') === 'bullying' ? 'selected' : '' }}>Perundungan (Bullying)</option>
                    <option value="fasilitas" {{ old('kategori') === 'fasilitas' ? 'selected' : '' }}>Fasilitas Sekolah</option>
                    <option value="akademik" {{ old('kategori') === 'akademik' ? 'selected' : '' }}>Akademik / Pembelajaran</option>
                    <option value="lainnya" {{ old('kategori') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('kategori')
                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kategori Lainnya (Custom Input) -->
            <div id="kategori-lainnya-wrapper" class="mb-5 hidden">
                <label for="kategori_lainnya" class="block text-sm font-semibold text-slate-800 mb-2">Sebutkan Kategori Lainnya</label>
                <input type="text" name="kategori_lainnya" id="kategori_lainnya" value="{{ old('kategori_lainnya') }}"
                    placeholder="Contoh: Keamanan, Kebersihan, Ketertiban..."
                    class="block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-slate-400">
            </div>

            <!-- Isi Pengaduan -->
            <div class="mb-6">
                <label for="isi_pengaduan" class="block text-sm font-semibold text-slate-800 mb-2">Isi Laporan / Detail Kejadian</label>
                <textarea name="isi_pengaduan" id="isi_pengaduan" rows="5" maxlength="2000"
                    placeholder="Tuliskan kronologi kejadian secara lengkap, sertakan waktu, tempat, dan pihak yang terlibat jika memungkinkan..."
                    class="block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-slate-400">{{ old('isi_pengaduan') }}</textarea>
                <div class="mt-1 flex justify-between items-center text-[10px]">
                    <span id="char-counter" class="text-slate-400 font-semibold">0 / 2000 karakter</span>
                    <span id="draft-status" class="text-indigo-600 font-bold italic opacity-0 transition-opacity duration-300">Draft disimpan otomatis</span>
                </div>
                @error('isi_pengaduan')
                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-3 pt-4 border-t border-slate-200">
                <a href="{{ route('dashboard') }}" 
                    class="w-full sm:w-auto text-center px-4 py-2.5 border border-slate-300 text-sm font-semibold rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors cursor-pointer">
                    Batal
                </a>
                
                <button type="submit" 
                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors shadow-sm cursor-pointer">
                    Kirim Laporan Pengaduan
                </button>
            </div>

        </form>
    </div>

    <!-- LocalStorage & Character Counter Script -->
    <script>
        const form = document.querySelector('form');
        const judulInput = document.getElementById('judul');
        const kategoriSelect = document.getElementById('kategori');
        const isiTextarea = document.getElementById('isi_pengaduan');
        const charCounter = document.getElementById('char-counter');
        const draftStatus = document.getElementById('draft-status');

        const STORAGE_KEY = 'siswa_pengaduan_draft';

        // Update Character Counter
        function updateCounter() {
            const currentLen = isiTextarea.value.length;
            charCounter.textContent = `${currentLen} / 2000 karakter`;
            if (currentLen >= 1900) {
                charCounter.className = "text-red-500 font-extrabold";
            } else {
                charCounter.className = "text-slate-400 font-semibold";
            }
        }

        const kategoriLainnyaWrapper = document.getElementById('kategori-lainnya-wrapper');
        const kategoriLainnyaInput = document.getElementById('kategori_lainnya');

        function toggleKategoriLainnya() {
            if (kategoriSelect.value === 'lainnya') {
                kategoriLainnyaWrapper.classList.remove('hidden');
                kategoriLainnyaInput.setAttribute('required', 'required');
            } else {
                kategoriLainnyaWrapper.classList.add('hidden');
                kategoriLainnyaInput.removeAttribute('required');
            }
        }

        // Save Draft to LocalStorage
        let saveTimeout;
        function saveDraft() {
            draftStatus.classList.remove('opacity-0');
            draftStatus.classList.add('opacity-100');

            const draftData = {
                judul: judulInput.value,
                kategori: kategoriSelect.value,
                kategori_lainnya: kategoriLainnyaInput.value,
                isi_pengaduan: isiTextarea.value
            };
            localStorage.setItem(STORAGE_KEY, JSON.stringify(draftData));

            // Hide draft status after 1.5 seconds
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(() => {
                draftStatus.classList.remove('opacity-100');
                draftStatus.classList.add('opacity-0');
            }, 1500);
        }

        // Load Draft
        function loadDraft() {
            const rawDraft = localStorage.getItem(STORAGE_KEY);
            if (rawDraft) {
                try {
                    const draftData = JSON.parse(rawDraft);
                    if (draftData.judul && !judulInput.value) {
                        judulInput.value = draftData.judul;
                    }
                    if (draftData.kategori && !kategoriSelect.value) {
                        kategoriSelect.value = draftData.kategori;
                    }
                    if (draftData.kategori_lainnya && !kategoriLainnyaInput.value) {
                        kategoriLainnyaInput.value = draftData.kategori_lainnya;
                    }
                    if (draftData.isi_pengaduan && !isiTextarea.value) {
                        isiTextarea.value = draftData.isi_pengaduan;
                    }
                } catch (e) {
                    console.error('Failed to parse draft', e);
                }
            }
            updateCounter();
        }

        // Attach listeners
        isiTextarea.addEventListener('input', () => {
            updateCounter();
            saveDraft();
        });
        judulInput.addEventListener('input', saveDraft);
        kategoriLainnyaInput.addEventListener('input', saveDraft);
        kategoriSelect.addEventListener('change', () => {
            toggleKategoriLainnya();
            saveDraft();
        });

        // Clear Draft on Submit
        form.addEventListener('submit', () => {
            localStorage.removeItem(STORAGE_KEY);
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            // Apply dark mode if enabled in local storage
            if (localStorage.getItem('dark-mode') === 'enabled') {
                document.body.classList.add('dark-mode');
            }
            loadDraft();
            toggleKategoriLainnya();
        });
    </script>
</body>
</html>
