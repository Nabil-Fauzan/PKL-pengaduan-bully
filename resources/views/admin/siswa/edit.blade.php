@extends('layouts.admin')

@section('title', 'Ubah Data Siswa')
@section('page_title', 'Ubah Siswa')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        
        <div class="card card-primary card-outline mb-5">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-edit mr-1"></i>
                    Formulir Pembaruan Data Siswa
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.siswa') }}" class="btn btn-default btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="icon fas fa-ban mr-2"></i> <strong>Ada kesalahan pengisian:</strong>
                        <ul class="mb-0 mt-1 pl-3 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('admin.siswa.update', $siswa->id_siswa) }}" method="POST">
                    @csrf
                    
                    <!-- NIS -->
                    <div class="form-group">
                        <label for="nis" class="font-weight-bold">NIS (Nomor Induk Siswa):</label>
                        <input type="text" name="nis" id="nis" value="{{ old('nis', $siswa->nis) }}" 
                            placeholder="Masukkan NIS unik siswa..." class="form-control" required>
                        <small class="form-text text-muted">Akan digunakan oleh siswa sebagai username saat login.</small>
                    </div>

                    <!-- Nama -->
                    <div class="form-group mt-3">
                        <label for="nama" class="font-weight-bold">Nama Lengkap Siswa:</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $siswa->nama) }}" 
                            placeholder="Masukkan nama lengkap siswa..." class="form-control" required>
                    </div>

                    <!-- Kelas -->
                    <div class="form-group mt-3">
                        <label for="kelas" class="font-weight-bold">Kelas:</label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            <option value="X" {{ old('kelas', $siswa->kelas) === 'X' ? 'selected' : '' }}>X (Sepuluh)</option>
                            <option value="XI" {{ old('kelas', $siswa->kelas) === 'XI' ? 'selected' : '' }}>XI (Sebelas)</option>
                            <option value="XII" {{ old('kelas', $siswa->kelas) === 'XII' ? 'selected' : '' }}>XII (Dua Belas)</option>
                        </select>
                    </div>

                    <!-- Jurusan -->
                    <div class="form-group mt-3">
                        <label for="jurusan" class="font-weight-bold">Jurusan:</label>
                        <select name="jurusan" id="jurusan" class="form-control" required>
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach($list_jurusan as $jurusan)
                                <option value="{{ $jurusan }}" {{ old('jurusan', $siswa->jurusan) === $jurusan ? 'selected' : '' }}>{{ $jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-3">
                        <label for="password" class="font-weight-bold">Ganti Password Akun (Opsional):</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" 
                                placeholder="Biarkan kosong jika tidak ingin mengubah password..." class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text" id="togglePasswordBtn" style="cursor: pointer;">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </span>
                            </div>
                        </div>
                        <small class="form-text text-muted">Hanya diisi jika siswa meminta reset/ganti password. Minimal 4 karakter.</small>
                    </div>

                    <!-- Status -->
                    <div class="form-group mt-3">
                        <label for="status" class="font-weight-bold">Status Akun Siswa:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="aktif" {{ old('status', $siswa->status) === 'aktif' ? 'selected' : '' }}>Aktif (Dapat Login)</option>
                            <option value="lulus" {{ old('status', $siswa->status) === 'lulus' ? 'selected' : '' }}>Lulus (Kunci Akses)</option>
                            <option value="pindah" {{ old('status', $siswa->status) === 'pindah' ? 'selected' : '' }}>Pindah Sekolah (Kunci Akses)</option>
                        </select>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                        <a href="{{ route('admin.siswa') }}" class="btn btn-default mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary font-weight-bold">
                            <i class="fas fa-save mr-1"></i> Perbarui Data Siswa
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const eyeIcon = document.getElementById('eyeIcon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        }
    });
</script>
@endsection
