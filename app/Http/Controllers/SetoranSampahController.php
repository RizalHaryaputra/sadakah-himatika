<?php

namespace App\Http\Controllers;

use App\Exports\SetoranExport;
use App\Models\User;
use App\Models\SetoranSampah;
use App\Models\KategoriSampah;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSetoranSampahRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SweetAlert2\Laravel\Swal;

class SetoranSampahController extends Controller
{
    private const PAGINATION_COUNT = 5;

    /**
     * Menampilkan daftar setoran sampah.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Eager load relasi untuk optimasi query
        $query = SetoranSampah::with(['nasabah.padukuhan', 'operator', 'kategoriSampah']);

        if ($user->hasRole('Operator Padukuhan')) {
            // Operator hanya melihat setoran dari nasabah di padukuhannya
            $padukuhanId = $user->padukuhan_id;
            $query->whereHas('nasabah', function ($q) use ($padukuhanId) {
                $q->where('padukuhan_id', $padukuhanId);
            });
        }
        // Filter pencarian jika diisi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('nasabah', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $setoranSampah = $query->latest()->paginate(self::PAGINATION_COUNT)->withQueryString();

        foreach ($setoranSampah as $setoran) {
            $totalPoin = ($setoran->points_earned  * 100  / 90 );
            $operator_poin = floor($setoran->points_earned * 0.10);
        }

        return view('admin.setoran.index', compact('setoranSampah'));
    }

    /**
     * Menampilkan form untuk membuat setoran baru.
     */
    public function create()
    {
        $user = Auth::user();
        $nasabahQuery = User::role('Nasabah');

        // Filter nasabah berdasarkan padukuhan jika yang login adalah Operator
        if ($user->hasRole('Operator Padukuhan')) {
            $nasabahQuery->where('padukuhan_id', $user->padukuhan_id);
        }

        $nasabahs = $nasabahQuery->orderBy('name')->get();
        $kategoriSampah = KategoriSampah::orderBy('name')->get();


        return view('admin.setoran.create', compact('nasabahs', 'kategoriSampah'));
    }

    /**
     * Menyimpan setoran baru dan mengkalkulasi poin.
     */
    public function store(StoreSetoranSampahRequest $request)
    {
        $validated = $request->validated();

        // Ambil data nasabah dan kategori untuk kalkulasi
        $nasabah = User::findOrFail($validated['nasabah_id']);
        $kategori = KategoriSampah::findOrFail($validated['kategori_sampah_id']);

        // Hitung total poin berdasarkan berat dan poin per kg
        $totalPoints = floor($validated['weight_kg'] * $kategori->points_per_kg);

        // Bagi poin: 90% untuk nasabah, 10% untuk operator
        $pointsForOperator = floor($totalPoints * 0.10);
        $pointsForNasabah = $totalPoints - $pointsForOperator;

        try {
            DB::transaction(function () use ($validated, $nasabah, $pointsForNasabah, $pointsForOperator) {
                // Tambah data ke tabel setoran_sampah
                SetoranSampah::create([
                    'nasabah_id' => $validated['nasabah_id'],
                    'kategori_sampah_id' => $validated['kategori_sampah_id'],
                    'operator_id' => Auth::id(),
                    'weight_kg' => $validated['weight_kg'],
                    'points_earned' => $pointsForNasabah,
                    'collection_date' => $validated['collection_date'],
                    'notes' => $validated['notes'],
                ]);

                // Tambahkan poin ke operator
                $operator = Auth::user();
                $operator->increment('total_poin', $pointsForOperator);

                // Tambahkan poin ke nasabah
                $nasabah->increment('total_poin', $pointsForNasabah);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi. Silakan coba lagi.')->withInput();
        }

        Swal::toastSuccess([
            'title' => 'Setoran berhasil ditambahkan',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);

        return redirect()->route('admin.setoran.index')->with('success', 'Setoran sampah berhasil ditambahkan.');
    }


    /**
     * Menampilkan detail setoran.
     */
    public function show(SetoranSampah $setoran)
    {
        return view('admin.setoran.show', compact('setoran'));
    }

    /**
     * Menghapus data setoran dan mengembalikan poin nasabah.
     */
    public function destroy(SetoranSampah $setoran)
    {
        try {
            DB::transaction(function () use ($setoran) {
                // 1. Kembalikan (kurangi) poin nasabah
                $nasabah = $setoran->nasabah;
                $nasabah->decrement('total_poin', $setoran->points_earned);

                // 2. Hapus data setoran (soft delete)
                $setoran->delete();
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus transaksi. Silakan coba lagi.');
        }

        Swal::toastSuccess([
            'title' => 'Setoran berhasil dihapus',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.setoran.index')->with('success', 'Setoran sampah berhasil dihapus dan poin telah dikembalikan.');
    }

    /**
     * Menangani permintaan ekspor data setoran ke Excel.
     */
    public function export(Request $request)
    {
        // Ambil keyword pencarian dari request
        $search = $request->input('search');

        // Buat nama file yang dinamis dengan tanggal hari ini
        $fileName = 'data-setoran-' . date('Y-m-d') . '.xlsx';

        // Panggil class SetoranExport, kirim parameter pencarian, dan unduh filenya
        return Excel::download(new SetoranExport($search), $fileName);
    }
}
