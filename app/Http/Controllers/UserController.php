<?php

namespace App\Http\Controllers;

use App\Exports\PenggunaExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Padukuhan;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use SweetAlert2\Laravel\Swal;

class UserController extends Controller
{
    private const PAGINATION_COUNT = 5;
    private const DEFAULT_IMAGE = 'profile_pictures/profile.png';

    public function index(Request $request)
    {
        /// Ambil pengguna yang sedang login
        $pengguna = Auth::user();

        // Ambil keyword pencarian dari input
        $search = $request->input('search');

        // 1. Mulai dengan query dasar, mengambil semua relasi yang dibutuhkan.
        //    Tidak ada filter peran di sini.
        $query = User::with('padukuhan', 'roles');

        // 2. Terapkan filter berdasarkan peran pengguna yang login.
        if ($pengguna->hasRole('Super Admin')) {
            // Super Admin bisa melihat semua pengguna, KECUALI dirinya sendiri
            // untuk mencegah aksi yang tidak diinginkan (misal: menghapus akun sendiri).
            $query->where('id', '!=', $pengguna->id);
        } elseif ($pengguna->hasRole('Operator Padukuhan')) {
            // Operator hanya bisa melihat pengguna dengan peran 'Nasabah'
            // DAN yang berada di padukuhan yang sama dengannya.
            $query->where('padukuhan_id', $pengguna->padukuhan_id)
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'Nasabah');
                });
        }

        // 3. Terapkan filter pencarian setelah filter peran.
        //    Pencarian akan dilakukan pada data yang sudah difilter sesuai hak akses.
        $query->when($search, function ($q) use ($search) {
            $q->where(function ($subQ) use ($search) {
                $subQ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        });

        // 4. Eksekusi query dengan paginasi dan urutan terbaru.
        $users = $query->latest()->paginate(self::PAGINATION_COUNT)->appends($request->query());

        // 5. Kembalikan view dengan data pengguna
        return view('admin.pengguna.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name');
        $padukuhan = Padukuhan::pluck('name', 'id');
        return view('admin.pengguna.create', compact('roles', 'padukuhan'));
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);
        $validated['profile_picture'] = $this->handleImageUpload($request);

        $pengguna = User::create($validated);
        $pengguna->assignRole($validated['role']);

        // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Pengguna berhasil ditambahkan',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show(User $pengguna)
    {
        return view('admin.pengguna.show', compact('pengguna'));
    }

    public function edit(User $pengguna)
    {
        $roles = Role::pluck('name', 'name');
        $padukuhan = Padukuhan::pluck('name', 'id');
        return view('admin.pengguna.edit', compact('pengguna', 'roles', 'padukuhan'));
    }

    public function update(UpdateUserRequest $request, User $pengguna)
    {
        $validated = $request->validated();

        // Hanya update password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $this->handleImageUpload($request, $pengguna->profile_picture);
        }

        $pengguna->update($validated);
        $pengguna->syncRoles($validated['role']);

        // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Pengguna berhasil diperbarui',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        // Jangan biarkan pengguna menghapus dirinya sendiri
        if ($pengguna->id === Auth::id()) {
            return redirect()->route('admin.pengguna.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        // Hapus gambar profil jika bukan default
        if ($pengguna->profile_picture && $pengguna->profile_picture !== self::DEFAULT_IMAGE) {
            Storage::disk('public')->delete($pengguna->profile_picture);
        }

        $pengguna->delete();

        // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Pengguna berhasil dihapus',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    private function handleImageUpload($request, $oldImagePath = null): string
    {
        if ($request->hasFile('profile_picture')) {
            if ($oldImagePath && $oldImagePath !== self::DEFAULT_IMAGE) {
                Storage::disk('public')->delete($oldImagePath);
            }
            return $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        return $oldImagePath ?? self::DEFAULT_IMAGE;
    }

    public function export(Request $request)
    {
        // Ambil keyword pencarian dari request
        $search = $request->input('search');

        // Buat nama file yang dinamis dengan tanggal hari ini
        $fileName = 'data-pengguna-' . date('Y-m-d') . '.xlsx';

        // Panggil class PenggunaExport, kirim parameter pencarian, dan unduh filenya
        return Excel::download(new PenggunaExport($search), $fileName);
    }
}
