@extends('layouts.admin')

@section('title', 'Tambah Petugas/Admin Baru')
@section('page_title', 'Tambah Petugas')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-plus mr-1"></i>
                    Formulir Registrasi Akun Petugas Baru
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.petugas') }}" class="btn btn-default btn-sm">
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

                <form action="{{ route('admin.petugas.simpan') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama" class="font-weight-bold">Nama Lengkap Petugas:</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" 
                            placeholder="Masukkan nama lengkap beserta gelar..." class="form-control" required>
                    </div>

                    <!-- Username -->
                    <div class="form-group mt-3">
                        <label for="username" class="font-weight-bold">Username Akun:</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" 
                            placeholder="Masukkan username unik..." class="form-control" required>
                        <small class="form-text text-muted">Akan digunakan untuk login ke panel back-end.</small>
                    </div>

                    <!-- Email -->
                    <div class="form-group mt-3">
                        <label for="email" class="font-weight-bold">Alamat Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                            placeholder="Masukkan email aktif..." class="form-control" required>
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-3">
                        <label for="password" class="font-weight-bold">Password Akun:</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" 
                                placeholder="Masukkan password akun baru..." class="form-control" required>
                            <div class="input-group-append">
                                <button type="button" id="togglePasswordBtn" class="btn btn-outline-secondary">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Minimal 4 karakter.</small>
                    </div>

                    <!-- Role -->
                    <div class="form-group mt-3">
                        <label for="role" class="font-weight-bold">Hak Akses / Peran:</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="petugas" {{ old('role') === 'petugas' ? 'selected' : '' }}>Petugas BK (Bimbingan Konseling)</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator (Akses Penuh)</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="form-group mt-3">
                        <label for="status" class="font-weight-bold">Status Akun:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif (Dapat Login)</option>
                            <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif (Kunci Akses)</option>
                        </select>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-4 pt-3 border-t d-flex justify-content-end">
                        <a href="{{ route('admin.petugas') }}" class="btn btn-default mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary font-weight-bold">
                            <i class="fas fa-save mr-1"></i> Simpan Data Petugas
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
    document.getElementById('togglePasswordBtn').addEventListener('click', function() {
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
</script>
