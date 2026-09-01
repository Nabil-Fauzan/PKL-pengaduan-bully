@extends('layouts.admin')

@section('title', 'Detail Pengaduan & Tanggapan')
@section('page_title', 'Detail Pengaduan')

@section('content')
<div class="row">
    <!-- Left Column: Complaint Details -->
    <div class="col-md-7">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-file-alt mr-1"></i>
                    Informasi Pengaduan
                </h3>
                <div class="card-tools">
                    <a href="{{ route('dashboard') }}" class="btn btn-default btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Meta Info Table -->
                <table class="table table-bordered mb-4">
                    <tbody>
                        <tr>
                            <th style="width: 30%;">Siswa Pelapor</th>
                            <td>
                                <strong>{{ $pengaduan->siswa->nama }}</strong>
                                <span class="text-muted ml-2">(NIS: {{ $pengaduan->siswa->nis }})</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
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
                        </tr>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <td>{{ $pengaduan->tanggal_pengaduan->format('d F Y | H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <th>Status Terkini</th>
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
                        </tr>
                    </tbody>
                </table>

                <h5 class="font-weight-bold text-dark mb-2">Judul Laporan:</h5>
                <p class="text-dark bg-light p-3 rounded border" style="font-size: 1.1rem; font-weight: 500;">
                    {{ $pengaduan->judul }}
                </p>

                <h5 class="font-weight-bold text-dark mt-4 mb-2">Kronologi / Isi Laporan:</h5>
                <div class="bg-light p-3 rounded border text-muted" style="white-space: pre-wrap; line-height: 1.6;">{{ $pengaduan->isi_pengaduan }}</div>
            </div>
        </div>

        <!-- History of Counselor Responses -->
        <div class="card card-secondary card-outline mt-4">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-comments mr-1"></i>
                    Riwayat Tanggapan / Tindak Lanjut
                </h3>
            </div>
            <div class="card-body">
                @if($pengaduan->tanggapan->isEmpty())
                    <p class="text-muted text-center py-3 mb-0">Belum ada tindakan atau tanggapan tertulis untuk laporan ini.</p>
                @else
                    <div class="timeline timeline-inverse">
                        @foreach($pengaduan->tanggapan as $tanggapan)
                            <div>
                                <i class="fas fa-comment bg-primary"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> {{ $tanggapan->tanggal_tanggapan->format('d/m/Y H:i') }} WIB</span>
                                    <h3 class="timeline-header font-weight-bold text-primary">
                                        {{ $tanggapan->petugas->nama }}
                                        <span class="text-muted font-weight-normal">menanggapi dengan status</span>
                                        @if($tanggapan->status_pengaduan === 'diproses')
                                            <span class="badge bg-warning text-dark">Diproses</span>
                                        @elseif($tanggapan->status_pengaduan === 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </h3>
                                    <div class="timeline-body text-dark" style="white-space: pre-wrap;">{{ $tanggapan->isi_tanggapan }}</div>
                                </div>
                            </div>
                        @endforeach
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column: Response Action Form -->
    <div class="col-md-5">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-reply mr-1"></i>
                    Berikan Tanggapan & Tindak Lanjut
                </h3>
            </div>
            <div class="card-body">
                @if(session('success_message'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="icon fas fa-check mr-2"></i> {{ session('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="icon fas fa-ban mr-2"></i> <strong>Ada kesalahan:</strong>
                        <ul class="mb-0 pl-3 mt-1 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('petugas.pengaduan.tanggapan', $pengaduan->id_pengaduan) }}" method="POST">
                    @csrf
                    
                    <!-- Action Status -->
                    <div class="form-group">
                        <label for="status_pengaduan" class="font-weight-bold">Perbarui Status Laporan:</label>
                        <select name="status_pengaduan" id="status_pengaduan" class="form-control">
                            <option value="">-- Pilih Status Baru --</option>
                            <option value="diproses" {{ old('status_pengaduan', $pengaduan->status) === 'diproses' ? 'selected' : '' }}>Diproses (Sedang diselidiki)</option>
                            <option value="selesai" {{ old('status_pengaduan', $pengaduan->status) === 'selesai' ? 'selected' : '' }}>Selesai (Kasus ditutup)</option>
                            <option value="ditolak" {{ old('status_pengaduan', $pengaduan->status) === 'ditolak' ? 'selected' : '' }}>Ditolak (Iseng/Palsu)</option>
                        </select>
                        <small class="form-text text-muted">Mengubah status di sini akan mengubah status yang dilihat oleh siswa secara langsung.</small>
                    </div>

                    <!-- Tanggapan Textarea -->
                    <div class="form-group mt-4">
                        <label for="isi_tanggapan" class="font-weight-bold">Isi Tanggapan Resmi BK:</label>
                        <textarea name="isi_tanggapan" id="isi_tanggapan" rows="6" class="form-control" 
                            placeholder="Tuliskan keterangan tindakan, pemanggilan siswa, koordinasi dengan wali kelas, atau penyelesaian masalah secara rinci..."></textarea>
                        <small class="form-text text-muted">Minimal menulis 5 karakter. Tanggapan Anda akan muncul di riwayat portal siswa pelapor secara transparan.</small>
                    </div>

                    <!-- Quick Response Templates -->
                    <div class="form-group mt-3">
                        <span class="text-xs font-weight-bold text-muted d-block mb-1"><i class="fas fa-magic mr-1"></i> Pilih Templat Tanggapan Cepat:</span>
                        <div class="d-flex flex-column gap-1">
                            <button type="button" class="btn btn-xs btn-outline-info text-left mb-1 quick-template-btn" 
                                data-text="Laporan Anda telah kami terima dan sedang dalam penyelidikan awal. Pihak BK akan segera memanggil pihak-pihak terkait untuk dimintai keterangan lebih lanjut." 
                                data-status="diproses">
                                <i class="fas fa-spinner mr-1"></i> <strong>Penyelidikan Awal</strong>: Laporan sedang diselidiki.
                            </button>
                            <button type="button" class="btn btn-xs btn-outline-success text-left mb-1 quick-template-btn" 
                                data-text="Masalah perundungan ini telah dimediasi oleh pihak BK. Seluruh pihak terkait telah dipanggil dan sepakat berdamai. Laporan dinyatakan selesai dan ditutup." 
                                data-status="selesai">
                                <i class="fas fa-check-circle mr-1"></i> <strong>Selesai & Damai</strong>: Pihak terkait dipanggil dan sepakat damai.
                            </button>
                            <button type="button" class="btn btn-xs btn-outline-danger text-left mb-1 quick-template-btn" 
                                data-text="Setelah dilakukan penelusuran lebih lanjut, laporan ini ditolak karena informasi yang diberikan kurang lengkap atau tidak ditemukan unsur perundungan di lapangan." 
                                data-status="ditolak">
                                <i class="fas fa-times-circle mr-1"></i> <strong>Tidak Cukup Bukti</strong>: Informasi kurang lengkap atau nihil bullying.
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-success btn-block font-weight-bold">
                            <i class="fas fa-paper-plane mr-1"></i> Kirim Tanggapan & Perbarui Laporan
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
        const quickBtns = document.querySelectorAll('.quick-template-btn');
        const textarea = document.getElementById('isi_tanggapan');
        const statusSelect = document.getElementById('status_pengaduan');

        quickBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                textarea.value = this.getAttribute('data-text');
                const targetStatus = this.getAttribute('data-status');
                if (statusSelect) {
                    statusSelect.value = targetStatus;
                }
            });
        });
    });
</script>
