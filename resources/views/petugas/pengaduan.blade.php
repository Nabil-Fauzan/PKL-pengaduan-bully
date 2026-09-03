@extends('layouts.admin')

@section('title', 'Data Pengaduan Siswa')
@section('page_title', 'Daftar Pengaduan')

@section('content')
<div class="row">
    <div class="col-12">
        
        <!-- Filter Card -->
        <div class="card card-default mb-4">
            <div class="card-header">
                <h2 class="card-title h5 font-weight-bold mb-0">
                    <i class="fas fa-filter mr-1"></i>
                    Saring & Cari Laporan
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.pengaduan') }}" method="GET" class="row">
                    <!-- Search query -->
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="search" class="text-sm font-weight-bold text-muted">Kata Kunci:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                placeholder="Cari judul, nama pelapor, atau NIS..." class="form-control form-control-sm">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-3 mb-3 mb-md-0">
                        <label for="status" class="text-sm font-weight-bold text-muted">Status Laporan:</label>
                        <select name="status" id="status" class="form-control form-control-sm">
                            <option value="">Semua Status</option>
                            <option value="baru" {{ request('status') === 'baru' ? 'selected' : '' }}>Baru (<= 3 Hari)</option>
                            <option value="terabaikan" {{ request('status') === 'terabaikan' ? 'selected' : '' }}>Terabaikan (> 3 Hari)</option>
                            <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <!-- Kategori Filter -->
                    <div class="col-md-3 mb-3 mb-md-0">
                        <label for="kategori" class="text-sm font-weight-bold text-muted">Kategori:</label>
                        <select name="kategori" id="kategori" class="form-control form-control-sm">
                            <option value="">Semua Kategori</option>
                            <option value="bullying" {{ request('kategori') === 'bullying' ? 'selected' : '' }}>Bullying</option>
                            <option value="fasilitas" {{ request('kategori') === 'fasilitas' ? 'selected' : '' }}>Fasilitas Sekolah</option>
                            <option value="akademik" {{ request('kategori') === 'akademik' ? 'selected' : '' }}>Akademik</option>
                            <option value="lainnya" {{ request('kategori') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <!-- Filter Actions -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-sm btn-block font-weight-bold">
                            <i class="fas fa-search mr-1"></i> Cari
                        </button>
                        
                        @if(request()->filled('search') || request()->filled('status') || request()->filled('kategori'))
                            <a href="{{ route('dashboard.pengaduan') }}" class="btn btn-default btn-sm ml-2" title="Reset Filter">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Print Only Header -->
        <div class="print-only mb-4 text-center">
            <h3 class="font-weight-bold mb-1">SMK TI AIRLANGGA SAMARINDA</h3>
            <h5 class="mb-1 font-weight-bold">REKAPITULASI DATA PENGADUAN SISWA & KASUS BULLYING</h5>
            <small class="text-muted">Dicetak pada: {{ now()->format('d F Y | H:i') }} WIB oleh {{ Auth::user()->nama }} ({{ ucfirst(Auth::user()->role) }})</small>
            <hr style="border-top: 2px solid #000; margin-top: 10px; margin-bottom: 20px;">
        </div>

        <!-- Data Card -->
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="card-title h5 font-weight-bold mb-0">
                    <i class="fas fa-list mr-1"></i>
                    Semua Data Pengaduan Masuk
                </h2>
                <div class="card-tools ml-auto no-print">
                    <button type="button" onclick="window.print()" class="btn btn-default btn-sm font-weight-bold" title="Cetak Rekap Laporan">
                        <i class="fas fa-print mr-1"></i> Cetak / PDF
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th style="width: 220px;">Siswa Pelapor</th>
                                <th>Judul Pengaduan</th>
                                <th style="width: 120px;">Kategori</th>
                                <th style="width: 180px;">Tanggal Masuk</th>
                                <th style="width: 150px;">Status</th>
                                <th style="width: 130px;" class="text-center no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = ($data_pengaduan->currentPage() - 1) * $data_pengaduan->perPage() + 1;
                            @endphp
                            @forelse($data_pengaduan as $pengaduan)
                                <tr>
                                    <td class="text-center font-weight-bold">{{ $no++ }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle text-white font-weight-bold d-flex align-items-center justify-content-center mr-2 shrink-0" 
                                                style="width: 32px; height: 32px; background-color: #4f46e5; font-size: 11px;">
                                                {{ strtoupper(substr($pengaduan->siswa->nama ?? 'S', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ $pengaduan->siswa->nama ?? 'Siswa' }}</div>
                                                <small class="text-muted">NIS: {{ $pengaduan->siswa->nis ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $pengaduan->judul }}</td>
                                    <td>
                                        @if($pengaduan->kategori === 'bullying')
                                            <span class="badge bg-danger">Bullying</span>
                                        @elseif($pengaduan->kategori === 'fasilitas')
                                            <span class="badge bg-info">Fasilitas</span>
                                        @elseif($pengaduan->kategori === 'akademik')
                                            <span class="badge bg-primary">Akademik</span>
                                        @else
                                            <span class="badge bg-secondary">Lainnya</span>
                                        @endif
                                    </td>
                                    <td>{{ $pengaduan->tanggal_pengaduan->format('d/m/Y | H:i') }} WIB</td>
                                    <td>
                                        @if($pengaduan->isTerabaikan())
                                            <span class="badge bg-danger">Terabaikan (>3 hari)</span>
                                        @elseif($pengaduan->status === 'baru')
                                            <span class="badge bg-primary">Baru</span>
                                        @elseif($pengaduan->status === 'diproses')
                                            <span class="badge bg-warning text-dark">Diproses</span>
                                        @elseif($pengaduan->status === 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center no-print">
                                        <a href="{{ route('petugas.pengaduan.detail', $pengaduan->id_pengaduan) }}" class="btn btn-primary btn-xs font-weight-bold">
                                            <i class="fas fa-reply mr-1"></i> Tanggapi
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Tidak ada laporan pengaduan yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pagination Footer -->
            @if($data_pengaduan->hasPages())
                <div class="card-footer clearfix d-flex justify-content-end no-print">
                    {{ $data_pengaduan->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>

    </div>
</div>

<style>
    .print-only {
        display: none;
    }
    @media print {
        .no-print, .main-header, .main-sidebar, .main-footer, .card:first-child, .content-header {
            display: none !important;
        }
        .print-only {
            display: block !important;
        }
        .content-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
            background-color: #fff !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .table {
            width: 100% !important;
            border-collapse: collapse !important;
        }
        .table th, .table td {
            border: 1px solid #333 !important;
            padding: 6px 8px !important;
            color: #000 !important;
        }
        .badge {
            border: 1px solid #333 !important;
            color: #000 !important;
            background: transparent !important;
        }
    }
</style>
@endsection
