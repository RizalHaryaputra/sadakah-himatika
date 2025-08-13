<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProdukKerajinan;
use App\Http\Requests\StoreProdukKerajinanRequest;
use App\Http\Requests\UpdateProdukKerajinanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class ProdukKerajinanController extends Controller
{
    /**
     * Konstanta untuk menghindari "magic numbers".
     */
    private const PAGINATION_COUNT = 5;
    private const DEFAULT_IMAGE = 'produk/produk.jpg'; // Path gambar default jika ada

    /**
     * Menampilkan daftar produk kerajinan.
     */
    public function index(Request $request)
    {
        $query = ProdukKerajinan::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        } else {
            $query->latest();
        }

        $produkKerajinan = $query->paginate(self::PAGINATION_COUNT)->withQueryString();
        return view('admin.produk.index', compact('produkKerajinan'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        return view('admin.produk.create');
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(StoreProdukKerajinanRequest $request)
    {
        $validated = $request->validated();
        $validated['image_url'] = $this->handleImageUpload($request);

        ProdukKerajinan::create($validated);

        Swal::toastSuccess([
            'title' => 'Produk berhasil ditambahkan',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu produk (tidak digunakan di admin, tapi bisa untuk halaman publik).
     */
    public function show(ProdukKerajinan $produk)
    {
        // Biasanya untuk halaman detail publik
        return view('public.produk.show', compact('produk'));
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit(ProdukKerajinan $produk)
    {
        return view('admin.produk.edit', compact('produk'));
    }

    /**
     * Memperbarui produk di database.
     */
    public function update(UpdateProdukKerajinanRequest $request, ProdukKerajinan $produk)
    {
        $validated = $request->validated();

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $this->handleImageUpload($request, $produk->image_url);
        }
        
        $produk->update($validated);

        Swal::toastSuccess([
            'title' => 'Produk berhasil diperbarui',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari database (soft delete).
     */
    public function destroy(ProdukKerajinan $produk)
    {
        // Hapus gambar lama dari storage jika bukan gambar default
        if ($produk->image_url && $produk->image_url !== self::DEFAULT_IMAGE) {
            Storage::disk('public')->delete($produk->image_url);
        }

        $produk->delete();

        Swal::toastSuccess([
            'title' => 'Produk berhasil dihapus',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
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
            return $request->file('image_url')->store('produk', 'public');
        }

        // Jika tidak ada gambar baru, kembalikan path gambar lama atau path default
        return $oldImagePath ?? self::DEFAULT_IMAGE;
    }
}