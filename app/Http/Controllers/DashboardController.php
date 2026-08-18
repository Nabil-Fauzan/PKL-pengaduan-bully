<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pengaduan;
use App\Models\Tanggapan;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard yang sesuai berdasarkan guard user.
     */
    public function index()
    {
        if (Auth::guard('siswa')->check()) {
            $siswa = Auth::guard('siswa')->user();
            $data_pengaduan = Pengaduan::where('id_siswa', $siswa->id_siswa)
                                        ->orderBy('tanggal_pengaduan', 'desc')
                                        ->get();
            return view('siswa.dashboard', compact('siswa', 'data_pengaduan'));
        }

        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            $totalComplaints = Pengaduan::count();
            $newComplaints = Pengaduan::where('status', 'baru')->count();
            $ignoredComplaints = Pengaduan::where('status', 'baru')
                                           ->where('tanggal_pengaduan', '<', now()->subDays(3))
                                           ->count();
            $processedComplaints = Pengaduan::where('status', 'diproses')->count();

            $recentComplaints = Pengaduan::with('siswa')
                                           ->orderBy('tanggal_pengaduan', 'desc')
                                           ->take(5)
                                           ->get();

            return view('petugas.dashboard', compact(
                'user',
                'totalComplaints',
                'newComplaints',
                'ignoredComplaints',
                'processedComplaints',
                'recentComplaints'
            ));
        }

        return redirect('/login')->withErrors(['login_identifier' => 'Silakan masuk terlebih dahulu.']);
    }

    /**
     * Tampilkan halaman pengaduan berdasarkan guard user.
     */
    public function pengaduan(Request $request)
    {
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('dashboard');
        }

        if (Auth::guard('web')->check()) {
            $query = Pengaduan::with('siswa');

            // Filter Status
            if ($request->filled('status')) {
                $status = $request->input('status');
                if ($status === 'terabaikan') {
                    $query->where('status', 'baru')
                          ->where('tanggal_pengaduan', '<', now()->subDays(3));
                } else {
                    $query->where('status', $status);
                }
            }

            // Filter Kategori
            if ($request->filled('kategori')) {
                $query->where('kategori', $request->input('kategori'));
            }

            // Search query
            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhereHas('siswa', function($sq) use ($search) {
                          $sq->where('nama', 'like', "%{$search}%")
                             ->orWhere('nis', 'like', "%{$search}%");
                      });
                });
            }

            $data_pengaduan = $query->orderBy('tanggal_pengaduan', 'desc')->paginate(10)->withQueryString();

            return view('petugas.pengaduan', compact('data_pengaduan'));
        }

        return redirect('/login')->withErrors(['login_identifier' => 'Silakan masuk terlebih dahulu.']);
    }

    /**
     * Tampilkan form pembuatan pengaduan baru oleh Siswa.
     */
    public function tambahPengaduan()
    {
        if (!Auth::guard('siswa')->check()) {
            return redirect('/login')->withErrors(['login_identifier' => 'Silakan masuk sebagai siswa terlebih dahulu.']);
        }

        return view('siswa.buat_pengaduan');
    }

    /**
     * Simpan pengaduan baru yang dikirim oleh Siswa.
     */
    public function simpanPengaduan(Request $request)
    {
        if (!Auth::guard('siswa')->check()) {
            return redirect('/login')->withErrors(['login_identifier' => 'Silakan masuk sebagai siswa terlebih dahulu.']);
        }

        $request->validate([
            'judul' => 'required|string|max:150',
            'kategori' => 'required|in:bullying,fasilitas,akademik,lainnya',
            'isi_pengaduan' => 'required|string',
        ], [
            'judul.required' => 'Judul pengaduan wajib diisi.',
            'judul.max' => 'Judul pengaduan tidak boleh lebih dari 150 karakter.',
            'kategori.required' => 'Kategori pengaduan wajib dipilih.',
            'kategori.in' => 'Kategori pengaduan yang dipilih tidak valid.',
            'isi_pengaduan.required' => 'Isi laporan pengaduan wajib diisi.',
        ]);

        Pengaduan::create([
            'id_siswa' => Auth::guard('siswa')->id(),
            'judul' => $request->input('judul'),
            'kategori' => $request->input('kategori'),
            'isi_pengaduan' => $request->input('isi_pengaduan'),
            'status' => 'baru',
        ]);

        return redirect()->route('dashboard.pengaduan')->with('success_message', 'Pengaduan Anda berhasil dikirim!');
    }

    /**
     * Tampilkan detail pengaduan beserta tanggapan untuk Siswa.
     */
    public function detailPengaduan(int $id)
    {
        if (!Auth::guard('siswa')->check()) {
            return redirect('/login')->withErrors(['login_identifier' => 'Silakan masuk sebagai siswa terlebih dahulu.']);
        }

        $siswaId = Auth::guard('siswa')->id();
        $pengaduan = Pengaduan::with(['tanggapan.petugas'])->where('id_siswa', $siswaId)->findOrFail($id);

        return view('siswa.detail_pengaduan', compact('pengaduan'));
    }

    /**
     * Tampilkan detail pengaduan beserta tanggapan untuk Petugas/Admin.
     */
    public function detailPengaduanPetugas(int $id)
    {
        if (!Auth::guard('web')->check()) {
            return redirect('/login')->withErrors(['login_identifier' => 'Silakan masuk sebagai petugas/admin terlebih dahulu.']);
        }

        $pengaduan = Pengaduan::with(['siswa', 'tanggapan.petugas'])->findOrFail($id);

        return view('petugas.detail_pengaduan', compact('pengaduan'));
    }

    /**
     * Simpan tanggapan petugas dan perbarui status laporan.
     */
    public function simpanTanggapanPetugas(Request $request, int $id)
    {
        if (!Auth::guard('web')->check()) {
            return redirect('/login')->withErrors(['login_identifier' => 'Silakan masuk sebagai petugas/admin terlebih dahulu.']);
        }

        $request->validate([
            'status_pengaduan' => 'required|in:diproses,selesai,ditolak',
            'isi_tanggapan' => 'required|string|min:5',
        ], [
            'status_pengaduan.required' => 'Status pengaduan wajib dipilih.',
            'status_pengaduan.in' => 'Status pengaduan tidak valid.',
            'isi_tanggapan.required' => 'Isi tanggapan wajib diisi.',
            'isi_tanggapan.min' => 'Isi tanggapan minimal 5 karakter.',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        
        // Update complaint status & responding officer
        $pengaduan->status = $request->input('status_pengaduan');
        $pengaduan->id_petugas = Auth::guard('web')->id();
        $pengaduan->save();

        // Create tanggapan record
        Tanggapan::create([
            'id_pengaduan' => $id,
            'id_user' => Auth::guard('web')->id(),
            'isi_tanggapan' => $request->input('isi_tanggapan'),
            'status_pengaduan' => $request->input('status_pengaduan'),
        ]);

        return redirect()->back()->with('success_message', 'Tanggapan berhasil dikirim dan status laporan diperbarui!');
    }
}

