<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hadiah;
use App\Http\Requests\StoreHadiahRequest;
use App\Http\Requests\UpdateHadiahRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class HadiahController extends Controller
{
    /**
     * Konstanta untuk menghindari "magic numbers".
     */
    private const PAGINATION_COUNT = 5;
    private const DEFAULT_IMAGE = 'hadiah/hadiah.jpg'; // Path gambar default

    /**
     * Menampilkan daftar hadiah.
     */
    public function index(Request $request)
    {
        $query = Hadiah::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        } else {
            $query->latest();
        }

        $hadiahPoin = $query->paginate(self::PAGINATION_COUNT)->withQueryString();
        return view('admin.hadiah.index', compact('hadiahPoin'));
    }

    /**
     * Menampilkan form untuk menambah hadiah baru.
     */
    public function create()
    {
        return view('admin.hadiah.create');
    }

    /**
     * Menyimpan hadiah baru ke database.
     */
    public function store(StoreHadiahRequest $request)
    {
        $validated = $request->validated();
        $validated['image_url'] = $this->handleImageUpload($request);

        Hadiah::create($validated);

        // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Hadiah berhasil ditambahkan',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.hadiah.index')->with('success', 'Hadiah berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu hadiah (opsional, bisa digunakan di halaman publik).
     */
    public function show(Hadiah $hadiah)
    {
        return view('public.hadiah.show', compact('hadiah'));
    }

    /**
     * Menampilkan form untuk mengedit hadiah.
     */
    public function edit(Hadiah $hadiah)
    {
        return view('admin.hadiah.edit', compact('hadiah'));
    }

    /**
     * Memperbarui hadiah di database.
     */
    public function update(UpdateHadiahRequest $request, Hadiah $hadiah)
    {
        $validated = $request->validated();

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $this->handleImageUpload($request, $hadiah->image_url);
        }

        $hadiah->update($validated);

        // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Hadiah berhasil diperbarui',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.hadiah.index')->with('success', 'Hadiah berhasil diperbarui.');
    }

    /**
     * Menghapus hadiah dari database (soft delete).
     */
    public function destroy(Hadiah $hadiah)
    {
        // Hapus gambar terkait jika bukan gambar default
        if ($hadiah->image_url && $hadiah->image_url !== self::DEFAULT_IMAGE) {
            Storage::disk('public')->delete($hadiah->image_url);
        }
        $hadiah->delete();

        // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Hadiah berhasil dihapus',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.hadiah.index')->with('success', 'Hadiah berhasil dihapus.');
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
            return $request->file('image_url')->store('hadiah', 'public');
        }

        // Jika tidak ada gambar baru, kembalikan path gambar lama atau path default
        return $oldImagePath ?? self::DEFAULT_IMAGE;
    }
}
