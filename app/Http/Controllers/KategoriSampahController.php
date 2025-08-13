<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriSampahRequest;
use App\Http\Requests\UpdateKategoriSampahRequest;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SweetAlert2\Laravel\Swal;

class KategoriSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = KategoriSampah::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        } else {
            $query->latest();
        }

        $kategoriSampah = $query->paginate(5)->withQueryString();
        return view('admin.kategori.index', compact('kategoriSampah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriSampahRequest $request)
    {
        KategoriSampah::create($request->validated());

        // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Kategori sampah berhasil ditambahkan',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori sampah berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(KategoriSampah $kategoriSampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriSampah $kategori)
    {
        //
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriSampahRequest $request, KategoriSampah $kategori)
    {
        try {
            $kategori->update($request->validated());

            // Menggunakan SweetAlert untuk menampilkan pesan sukses
            Swal::toastSuccess([
                'title' => 'Kategori sampah berhasil diperbarui',
                'position' => 'bottom-end',
                'showConfirmButton' => false,
                'width' => 'auto',
                'timer' => 3000,
            ]);
            return redirect()
                ->route('admin.kategori.index')
                ->with('success', 'Kategori sampah berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriSampah $kategori)
    {
        //
        try {
            // SweetAlert untuk menampilkan pesan sukses
            Swal::toastSuccess([
                'title' => 'Kategori berhasil dihapus',
                'position' => 'bottom-end',
                'showConfirmButton' => false,
                'width' => 'auto',
                'timer' => 3000,
            ]);
            $kategori->delete();
            return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
