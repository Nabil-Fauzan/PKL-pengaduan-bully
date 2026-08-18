@extends('layouts.admin')

@section('title', 'Dashboard Petugas')
@section('page_title', 'Dashboard')

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <!-- Box 1: Total Pengaduan -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalComplaints }}</h3>
                <p>Total Pengaduan</p>
            </div>
            <div class="icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <a href="{{ route('dashboard.pengaduan') }}" class="small-box-footer">
                Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Box 2: Pengaduan Baru -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $newComplaints }}</h3>
                <p>Pengaduan Baru</p>
            </div>
            <div class="icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <a href="{{ route('dashboard.pengaduan') }}" class="small-box-footer">
                Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Box 3: Sedang Diproses -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $processedComplaints }}</h3>
                <p>Sedang Diproses</p>
            </div>
            <div class="icon">
                <i class="fas fa-spinner"></i>
            </div>
            <a href="{{ route('dashboard.pengaduan') }}" class="small-box-footer">
                Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Box 4: Laporan Terabaikan -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $ignoredComplaints }}</h3>
                <p>Terabaikan (>3 hari)</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <a href="{{ route('dashboard.pengaduan') }}" class="small-box-footer">
                Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Chart Card Row -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card card-default card-outline">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-chart-bar mr-1"></i>
                    Grafik Distribusi Kategori Pengaduan
                </h3>
            </div>
            <div class="card-body">
                <div class="chart" style="position: relative; height: 260px; width: 100%;">
                    <canvas id="kategoriChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent complaints table -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card card-primary card-outline mb-5">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-history mr-1"></i>
                    5 Laporan Pengaduan Terbaru Masuk
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>Siswa Pelapor</th>
                                <th>Judul Pengaduan</th>
                                <th>Kategori</th>
                                <th>Tanggal Masuk</th>
                                <th>Status</th>
                                <th style="width: 150px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentComplaints as $index => $pengaduan)
                                <tr>
                                    <td class="text-center font-weight-bold">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="font-weight-bold text-dark">{{ $pengaduan->siswa->nama }}</div>
                                        <small class="text-muted">NIS: {{ $pengaduan->siswa->nis }}</small>
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
                                    <td class="text-center">
                                        <a href="{{ route('petugas.pengaduan.detail', $pengaduan->id_pengaduan) }}" class="btn btn-primary btn-xs font-weight-bold">
                                            <i class="fas fa-reply mr-1"></i> Tanggapi
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada pengaduan yang masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('kategoriChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Bullying', 'Fasilitas Sekolah', 'Akademik', 'Lainnya'],
                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: [
                        {{ $bullyingCount }},
                        {{ $fasilitasCount }},
                        {{ $akademikCount }},
                        {{ $lainnyaCount }}
                    ],
                    backgroundColor: [
                        '#dc3545', // Danger / Red
                        '#17a2b8', // Info / Blue-green
                        '#007bff', // Primary / Blue
                        '#6c757d'  // Secondary / Gray
                    ],
                    borderColor: [
                        '#dc3545',
                        '#17a2b8',
                        '#007bff',
                        '#6c757d'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    });
</script>
@endsection
