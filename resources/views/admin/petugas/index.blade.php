@extends('layouts.admin')

@section('title', 'Data Petugas / Admin')
@section('page_title', 'Data Petugas & Admin')

@section('content')
<div class="row">
    <div class="col-12">

        <!-- Action & Search Card -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <a href="{{ route('admin.petugas.tambah') }}" class="btn btn-primary btn-sm font-weight-bold">
                            <i class="fas fa-plus mr-1"></i> Tambah Petugas/Admin Baru
                        </a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('admin.petugas') }}" method="GET" class="float-md-right w-100" style="max-width: 350px;">
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="Cari nama, username, atau email..." class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request()->filled('search'))
                                        <a href="{{ route('admin.petugas') }}" class="btn btn-default" title="Reset Pencarian">
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
                    <i class="fas fa-user-tie mr-1"></i>
                    Daftar Akun Petugas & Admin
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px;" class="text-center">No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th style="width: 120px;">Role</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 220px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = ($data_petugas->currentPage() - 1) * $data_petugas->perPage() + 1;
                            @endphp
                            @forelse($data_petugas as $petugas)
                                <tr>
                                    <td class="text-center font-weight-bold">{{ $no++ }}</td>
                                    <td class="font-weight-bold">
                                        {{ $petugas->nama }}
                                        @if($petugas->id_user === Auth::guard('web')->id())
                                            <span class="badge bg-indigo text-white ml-1">Saya</span>
                                        @endif
                                    </td>
                                    <td>{{ $petugas->username }}</td>
                                    <td>{{ $petugas->email }}</td>
                                    <td>
                                        @if($petugas->role === 'admin')
                                            <span class="badge bg-danger">Administrator</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Petugas BK</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($petugas->status === 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <a href="{{ route('admin.petugas.edit', $petugas->id_user) }}" class="btn btn-success btn-xs font-weight-bold mr-1">
                                                <i class="fas fa-edit mr-1"></i> Ubah
                                            </a>
                                            
                                            @if($petugas->id_user !== Auth::guard('web')->id())
                                                <form action="{{ route('admin.petugas.toggle', $petugas->id_user) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status aktif petugas ini?');">
                                                    @csrf
                                                    @if($petugas->status === 'aktif')
                                                        <button type="submit" class="btn btn-danger btn-xs font-weight-bold">
                                                            <i class="fas fa-ban mr-1"></i> Nonaktifkan
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-primary btn-xs font-weight-bold">
                                                            <i class="fas fa-check mr-1"></i> Aktifkan
                                                        </button>
                                                    @endif
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-xs font-weight-bold" disabled title="Tidak bisa menonaktifkan akun sendiri">
                                                    <i class="fas fa-ban mr-1"></i> Nonaktifkan
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Tidak ada data petugas/admin ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($data_petugas->hasPages())
                <div class="card-footer clearfix d-flex justify-content-end">
                    {{ $data_petugas->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
