<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Setting;

class AdminController extends Controller
{
    /**
     * Helper to verify if the user is an admin.
     */
    private function checkAdmin()
    {
        if (!Auth::guard('web')->check() || Auth::guard('web')->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Administrator.');
        }
    }

    // ==========================================
    // --- SISWA CRUD ---
    // ==========================================

    /**
     * Display a list of Siswa.
     */
    public function siswaIndex(Request $request)
    {
        $this->checkAdmin();
        $query = Siswa::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
        }

        $data_siswa = $query->orderBy('nama', 'asc')->paginate(10)->withQueryString();
        return view('admin.siswa.index', compact('data_siswa'));
    }

    /**
     * Show form to create new Siswa.
     */
    public function siswaCreate()
    {
        $this->checkAdmin();
        $list_jurusan = Setting::getJurusan();
        return view('admin.siswa.create', compact('list_jurusan'));
    }

    /**
     * Store new Siswa in the database.
     */
    public function siswaStore(Request $request)
    {
        $this->checkAdmin();
        $list_jurusan = Setting::getJurusan();

        $request->validate([
            'nis' => 'required|string|max:20|unique:siswa,nis',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:' . implode(',', $list_jurusan),
            'password' => 'required|string|min:4',
            'status' => 'required|in:aktif,lulus,pindah',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan oleh siswa lain.',
            'nama.required' => 'Nama lengkap siswa wajib diisi.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'kelas.in' => 'Pilihan kelas tidak valid.',
            'jurusan.required' => 'Jurusan wajib dipilih.',
            'jurusan.in' => 'Pilihan jurusan tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 4 karakter.',
        ]);

        Siswa::create([
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas' => $request->input('kelas'),
            'jurusan' => $request->input('jurusan'),
            'password' => Hash::make($request->input('password')),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.siswa')->with('success_message', 'Akun siswa berhasil dibuat!');
    }

    /**
     * Show form to edit existing Siswa.
     */
    public function siswaEdit(int $id)
    {
        $this->checkAdmin();
        $siswa = Siswa::findOrFail($id);
        $list_jurusan = Setting::getJurusan();
        return view('admin.siswa.edit', compact('siswa', 'list_jurusan'));
    }

    /**
     * Update existing Siswa.
     */
    public function siswaUpdate(Request $request, int $id)
    {
        $this->checkAdmin();
        $siswa = Siswa::findOrFail($id);
        $list_jurusan = Setting::getJurusan();

        $request->validate([
            'nis' => 'required|string|max:20|unique:siswa,nis,' . $id . ',id_siswa',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:' . implode(',', $list_jurusan),
            'password' => 'nullable|string|min:4',
            'status' => 'required|in:aktif,lulus,pindah',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan oleh siswa lain.',
            'nama.required' => 'Nama lengkap siswa wajib diisi.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'kelas.in' => 'Pilihan kelas tidak valid.',
            'jurusan.required' => 'Jurusan wajib dipilih.',
            'jurusan.in' => 'Pilihan jurusan tidak valid.',
            'password.min' => 'Password minimal 4 karakter.',
        ]);

        $siswa->nis = $request->input('nis');
        $siswa->nama = $request->input('nama');
        $siswa->kelas = $request->input('kelas');
        $siswa->jurusan = $request->input('jurusan');
        $siswa->status = $request->input('status');

        if ($request->filled('password')) {
            $siswa->password = Hash::make($request->input('password'));
        }

        $siswa->save();
        return redirect()->route('admin.siswa')->with('success_message', 'Akun siswa berhasil diperbarui!');
    }

    /**
     * Toggle status of Siswa.
     */
    public function siswaToggleStatus(int $id)
    {
        $this->checkAdmin();
        $siswa = Siswa::findOrFail($id);
        $siswa->status = $siswa->status === 'aktif' ? 'lulus' : 'aktif';
        $siswa->save();

        return redirect()->back()->with('success_message', 'Status akun siswa berhasil diubah!');
    }

    // ==========================================
    // --- PETUGAS CRUD ---
    // ==========================================

    /**
     * Display a list of User (Petugas/Admin).
     */
    public function petugasIndex(Request $request)
    {
        $this->checkAdmin();
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $data_petugas = $query->orderBy('nama', 'asc')->paginate(10)->withQueryString();
        return view('admin.petugas.index', compact('data_petugas'));
    }

    /**
     * Show form to create new Petugas/Admin.
     */
    public function petugasCreate()
    {
        $this->checkAdmin();
        return view('admin.petugas.create');
    }

    /**
     * Store new Petugas/Admin.
     */
    public function petugasStore(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:user,username',
            'email' => 'required|email|max:100|unique:user,email',
            'password' => 'required|string|min:4',
            'role' => 'required|in:admin,petugas',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 4 karakter.',
        ]);

        User::create([
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.petugas')->with('success_message', 'Akun petugas/admin berhasil dibuat!');
    }

    /**
     * Show form to edit existing Petugas/Admin.
     */
    public function petugasEdit(int $id)
    {
        $this->checkAdmin();
        $petugas = User::findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }

    /**
     * Update existing Petugas/Admin.
     */
    public function petugasUpdate(Request $request, int $id)
    {
        $this->checkAdmin();
        $petugas = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:user,username,' . $id . ',id_user',
            'email' => 'required|email|max:100|unique:user,email,' . $id . ',id_user',
            'password' => 'nullable|string|min:4',
            'role' => 'required|in:admin,petugas',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 4 karakter.',
        ]);

        // Prevent deactivating or demoting self
        if (Auth::guard('web')->id() === $id) {
            if ($request->input('status') !== 'aktif') {
                return redirect()->back()->withInput()->withErrors(['status' => 'Anda tidak bisa menonaktifkan akun Anda sendiri yang sedang digunakan.']);
            }
            if ($request->input('role') !== 'admin') {
                return redirect()->back()->withInput()->withErrors(['role' => 'Anda tidak bisa mengubah peran Anda sendiri menjadi petugas.']);
            }
        }

        $petugas->nama = $request->input('nama');
        $petugas->username = $request->input('username');
        $petugas->email = $request->input('email');
        $petugas->role = $request->input('role');
        $petugas->status = $request->input('status');

        if ($request->filled('password')) {
            $petugas->password = Hash::make($request->input('password'));
        }

        $petugas->save();
        return redirect()->route('admin.petugas')->with('success_message', 'Akun petugas/admin berhasil diperbarui!');
    }

    /**
     * Toggle status of Petugas/Admin.
     */
    public function petugasToggleStatus(int $id)
    {
        $this->checkAdmin();

        // Prevent self deactivation
        if (Auth::guard('web')->id() === $id) {
            return redirect()->back()->with('error_message', 'Anda tidak bisa menonaktifkan akun Anda sendiri yang sedang digunakan.');
        }

        $petugas = User::findOrFail($id);
        $petugas->status = $petugas->status === 'aktif' ? 'nonaktif' : 'aktif';
        $petugas->save();

        return redirect()->back()->with('success_message', 'Status akun petugas/admin berhasil diubah!');
    }

    /**
     * Display the settings page.
     */
    public function settingsIndex()
    {
        $this->checkAdmin();
        $list_jurusan = Setting::getJurusan();
        return view('admin.setting', compact('list_jurusan'));
    }

    /**
     * Update the list of majors.
     */
    public function settingsUpdate(Request $request)
    {
        $this->checkAdmin();
        
        $request->validate([
            'jurusan' => 'required|array|min:1',
            'jurusan.*' => 'required|string|max:100',
        ], [
            'jurusan.required' => 'Daftar jurusan wajib diisi.',
            'jurusan.min' => 'Minimal harus ada 1 jurusan.',
            'jurusan.*.required' => 'Nama jurusan tidak boleh kosong.',
        ]);

        Setting::setJurusan($request->input('jurusan'));

        return redirect()->route('admin.setting')->with('success_message', 'Daftar pilihan jurusan berhasil diperbarui!');
    }
}
