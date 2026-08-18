@extends('layouts.admin')

@section('title', 'Pengaturan Jurusan')
@section('page_title', 'Pengaturan')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        @if(session('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="icon fas fa-check mr-2"></i> {{ session('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

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

        <div class="card card-primary card-outline mb-5">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-cogs mr-1"></i>
                    Pengaturan Pilihan Jurusan
                </h3>
            </div>
            
            <div class="card-body">
                <p class="text-muted">
                    Daftar di bawah ini menentukan pilihan jurusan yang akan muncul di dropdown formulir pendaftaran/edit akun siswa. Anda dapat menambah atau menghapus opsi jurusan secara dinamis.
                </p>
                <hr>

                <form action="{{ route('admin.setting.update') }}" method="POST">
                    @csrf
                    
                    <div id="jurusan-container">
                        <label class="font-weight-bold mb-2">Daftar Jurusan Aktif:</label>
                        @foreach($list_jurusan as $index => $jurusan)
                            <div class="input-group mb-3 jurusan-row">
                                <input type="text" name="jurusan[]" value="{{ $jurusan }}" 
                                    placeholder="Masukkan nama jurusan (contoh: Rekayasa Perangkat Lunak)..." 
                                    class="form-control" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger remove-jurusan-btn" title="Hapus Jurusan ini">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Button -->
                    <div class="mb-4">
                        <button type="button" id="add-jurusan-btn" class="btn btn-success btn-sm font-weight-bold">
                            <i class="fas fa-plus mr-1"></i> Tambah Opsi Jurusan Baru
                        </button>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-4 pt-3 border-t d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary font-weight-bold">
                            <i class="fas fa-save mr-1"></i> Simpan Semua Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<!-- Template Row for Dynamic JS Add -->
<template id="jurusan-row-template">
    <div class="input-group mb-3 jurusan-row">
        <input type="text" name="jurusan[]" placeholder="Masukkan nama jurusan (contoh: Animasi)..." 
            class="form-control" required>
        <div class="input-group-append">
            <button type="button" class="btn btn-danger remove-jurusan-btn" title="Hapus Jurusan ini">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </div>
</template>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('jurusan-container');
        const addButton = document.getElementById('add-jurusan-btn');
        const template = document.getElementById('jurusan-row-template');

        // Add major row
        addButton.addEventListener('click', function() {
            const clone = template.content.cloneNode(true);
            container.appendChild(clone);
        });

        // Remove major row (delegate event to container)
        container.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.remove-jurusan-btn');
            if (removeBtn) {
                const row = removeBtn.closest('.jurusan-row');
                const totalRows = container.querySelectorAll('.jurusan-row').length;
                if (totalRows > 1) {
                    row.remove();
                } else {
                    alert('Minimal harus ada 1 pilihan jurusan aktif.');
                }
            }
        });
    });
</script>
@endsection
