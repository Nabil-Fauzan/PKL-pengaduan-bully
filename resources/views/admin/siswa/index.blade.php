@extends('layouts.admin')

@section('title', 'Data Siswa')
@section('page_title', 'Data Siswa')

@section('content')
<div class="row">
    <div class="col-12">

        <!-- Action & Search Card -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <a href="{{ route('admin.siswa.tambah') }}" class="btn btn-primary btn-sm font-weight-bold">
                            <i class="fas fa-plus mr-1"></i> Tambah Siswa Baru
                        </a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('admin.siswa') }}" method="GET" class="float-md-right w-100" style="max-width: 350px;">
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="Cari nama siswa atau NIS..." class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request()->filled('search'))
                                        <a href="{{ route('admin.siswa') }}" class="btn btn-default" title="Reset Pencarian">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="icon fas fa-check mr-2"></i> {{ session('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="icon fas fa-ban mr-2"></i> {{ session('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- List Card -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-user-graduate mr-1"></i>
                    Daftar Akun Siswa
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px;" class="text-center">No</th>
                                <th>Nama Lengkap</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th style="width: 150px;">Status Akun</th>
                                <th style="width: 220px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = ($data_siswa->currentPage() - 1) * $data_siswa->perPage() + 1;
                            @endphp
                            @forelse($data_siswa as $siswa)
                                <tr>
                                    <td class="text-center font-weight-bold">{{ $no++ }}</td>
                                    <td class="text-dark font-weight-bold">{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->kelas }}</td>
                                    <td>{{ $siswa->jurusan }}</td>
                                    <td>
                                        @if($siswa->status === 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @elseif($siswa->status === 'lulus')
                                            <span class="badge bg-secondary">Lulus</span>
                                        @else
                                            <span class="badge bg-danger">Pindah</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <a href="{{ route('admin.siswa.edit', $siswa->id_siswa) }}" class="btn btn-success btn-xs font-weight-bold mr-1">
                                                <i class="fas fa-edit mr-1"></i> Ubah
                                            </a>
                                            
                                            <form action="{{ route('admin.siswa.toggle', $siswa->id_siswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status aktif akun siswa ini?');">
                                                @csrf
                                                @if($siswa->status === 'aktif')
                                                    <button type="submit" class="btn btn-danger btn-xs font-weight-bold">
                                                        <i class="fas fa-ban mr-1"></i> Nonaktifkan
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-primary btn-xs font-weight-bold">
                                                        <i class="fas fa-check mr-1"></i> Aktifkan
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Tidak ada data siswa ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($data_siswa->hasPages())
                <div class="card-footer clearfix d-flex justify-content-end">
                    {{ $data_siswa->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
