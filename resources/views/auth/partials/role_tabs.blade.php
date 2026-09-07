        <!-- Role Selector Pill -->
        <div class="tab-pill-container" role="tablist" aria-label="Pilih Peran Akun">
            <button type="button" id="tab-siswa" onclick="switchRole('siswa')" role="tab" aria-selected="{{ $role === 'siswa' ? 'true' : 'false' }}" aria-controls="field-siswa"
                class="tab-pill-btn {{ $role === 'siswa' ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
                Siswa
            </button>
            <button type="button" id="tab-petugas" onclick="switchRole('petugas')" role="tab" aria-selected="{{ $role === 'petugas' ? 'true' : 'false' }}" aria-controls="field-petugas"
                class="tab-pill-btn {{ $role === 'petugas' ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Petugas / Admin
            </button>
        </div>
