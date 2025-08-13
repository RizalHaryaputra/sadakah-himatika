<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class ArtikelController extends Controller
{
    /**
     * Menghindari "magic numbers" dengan konstanta.
     */
    private const PAGINATION_COUNT = 5;
    private const DEFAULT_IMAGE = 'artikel/artikel.jpg';

    /**
     * Menampilkan daftar artikel.
     */
    public function index(Request $request)
    {
        $query = Artikel::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        } else {
            $query->latest();
        }

        $kontenArtikel = $query->paginate(self::PAGINATION_COUNT)->withQueryString();
        return view('admin.artikel.index', compact('kontenArtikel'));
    }

    /**
     * Menampilkan form untuk membuat artikel baru.
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Menyimpan artikel baru ke database.
     */
    public function store(StoreArtikelRequest $request)
    {
        $validated = $request->validated();

        // Logika upload gambar dipindahkan ke method terpisah
        $validated['image_url'] = $this->handleImageUpload($request);

        Artikel::create($validated);

                // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Artikel berhasil ditambahkan',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu artikel (untuk halaman publik).
     */
    public function show(Artikel $artikel)
    {
        // Anda bisa membuat view untuk ini jika diperlukan
        // return view('public.artikel.show', compact('artikel'));
    }

    /**
     * Menampilkan form untuk mengedit artikel.
     */
    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    /**
     * Memperbarui artikel di database.
     */
    public function update(UpdateArtikelRequest $request, Artikel $artikel)
    {
        $validated = $request->validated();

        // Cek jika ada file gambar baru yang di-upload
        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $this->handleImageUpload($request, $artikel->image_url);
        }

        $artikel->update($validated);

                // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Artikel berhasil diperbarui',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Menghapus artikel dari database.
     */
    public function destroy(Artikel $artikel)
    {
        // Hapus gambar lama dari storage jika bukan gambar default
        if ($artikel->image_url && $artikel->image_url !== self::DEFAULT_IMAGE) {
            Storage::disk('public')->delete($artikel->image_url);
        }

        $artikel->delete();

        // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Artikel berhasil dihapus',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Private method untuk menangani logika upload gambar.
     * Bisa digunakan di method store() dan update().
     */
    private function handleImageUpload($request, $oldImagePath = null): string
    {
        if ($request->hasFile('image_url')) {
            // Hapus gambar lama jika ada dan bukan gambar default
            if ($oldImagePath && $oldImagePath !== self::DEFAULT_IMAGE) {
                Storage::disk('public')->delete($oldImagePath);
            }
            // Simpan gambar baru
            return $request->file('image_url')->store('artikel', 'public');
        }

        // Jika tidak ada gambar baru, kembalikan path gambar lama atau default
        return $oldImagePath ?? self::DEFAULT_IMAGE;
    }
}
