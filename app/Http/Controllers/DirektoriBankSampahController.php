<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DirektoriBankSampah;
use App\Http\Requests\StoreDirektoriBankSampahRequest;
use App\Http\Requests\UpdateDirektoriBankSampahRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class DirektoriBankSampahController extends Controller
{
    /**
     * Konstanta untuk menghindari "magic numbers".
     */
    private const PAGINATION_COUNT = 5;
    private const DEFAULT_IMAGE = 'bank/bank.jpg'; // Path gambar default

    /**
     * Menampilkan daftar lokasi bank sampah.
     */
    public function index(Request $request)
    {
        $query = DirektoriBankSampah::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        } else {
            $query->latest();
        }

        $lokasiBankSampah = $query->paginate(self::PAGINATION_COUNT)->withQueryString();
        return view('admin.bank.index', compact('lokasiBankSampah'));
    }

    /**
     * Menampilkan form untuk menambah lokasi baru.
     */
    public function create()
    {
        return view('admin.bank.create');
    }

    /**
     * Menyimpan lokasi baru ke database.
     */
    public function store(StoreDirektoriBankSampahRequest $request)
    {
        $validated = $request->validated();
        $validated['image_url'] = $this->handleImageUpload($request);

        DirektoriBankSampah::create($validated);

        Swal::toastSuccess([
            'title' => 'Bank Sampah berhasil ditambahkan',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.bank.index')->with('success', 'Lokasi Bank Sampah berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu lokasi (untuk halaman publik).
     */
    public function show(DirektoriBankSampah $bank)
    {
        //return view('public.bank.show', compact('bank'));
    }

    /**
     * Menampilkan form untuk mengedit lokasi.
     */
    public function edit(DirektoriBankSampah $bank)
    {
        return view('admin.bank.edit', compact('bank'));
    }

    /**
     * Memperbarui lokasi di database.
     */
    public function update(UpdateDirektoriBankSampahRequest $request, DirektoriBankSampah $bank)
    {
        $validated = $request->validated();

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $this->handleImageUpload($request, $bank->image_url);
        }

        $bank->update($validated);

        Swal::toastSuccess([
            'title' => 'Bank Sampah berhasil diperbarui',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.bank.index')->with('success', 'Lokasi Bank Sampah berhasil diperbarui.');
    }

    /**
     * Menghapus lokasi dari database (soft delete).
     */
    public function destroy(DirektoriBankSampah $bank)
    {
        // Hapus gambar lama dari storage jika bukan gambar default
        if ($bank->image_url && $bank->image_url !== self::DEFAULT_IMAGE) {
            Storage::disk('public')->delete($bank->image_url);
        }

        $bank->delete();

        Swal::toastSuccess([
            'title' => 'Bank Sampah berhasil dihapus',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.bank.index')->with('success', 'Lokasi Bank Sampah berhasil dihapus.');
    }

    /**
     * Private method untuk menangani logika upload gambar.
     */
    private function handleImageUpload($request, $oldImagePath = null): string
    {
        if ($request->hasFile('image_url')) {
            // Hapus gambar lama jika ada dan bukan gambar default
            if ($oldImagePath && $oldImagePath !== self::DEFAULT_IMAGE) {
                Storage::disk('public')->delete($oldImagePath);
            }
            // Simpan gambar baru
            return $request->file('image_url')->store('bank', 'public');
        }

        // Jika tidak ada gambar baru, kembalikan path gambar lama atau path default
        return $oldImagePath ?? self::DEFAULT_IMAGE;
    }
}
