<?php

namespace App\Http\Controllers;

use App\Mail\HadiahRequested;
use App\Models\Artikel;
use App\Models\DirektoriBankSampah;
use App\Models\Hadiah;
use App\Models\KategoriSampah;
use App\Models\PenukaranPoin;
use App\Models\ProdukKerajinan;
use App\Models\SetoranSampah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use SweetAlert2\Laravel\Swal;

class FrontController extends Controller
{
    //
    public function index()
    {
        $totalNasabah = User::whereHas('roles', fn($q) => $q->where('name', 'Nasabah'))->count();
        $totalSampahMasuk = SetoranSampah::sum('weight_kg');
        $totalTransaksi = SetoranSampah::count() + PenukaranPoin::count();
        $poinBeredar = User::whereHas('roles', fn($q) => $q->where('name', 'Nasabah'))->sum('total_poin');
        $produkKerajinan = ProdukKerajinan::where('is_active', true)->latest()->paginate(3);
        $kontenArtikel = Artikel::where('is_active', true)->latest()->paginate(3);
        $lokasiBankSampah = DirektoriBankSampah::latest()->paginate(3);
        $hadiahPoin = Hadiah::where('is_active', true)->where('stock', '>', 0)->latest()->paginate(3);
        $kategoriSampah = KategoriSampah::latest()->paginate(4);
        return view('front.index', compact('produkKerajinan', 'kontenArtikel', 'lokasiBankSampah', 'hadiahPoin', 'totalNasabah', 'totalSampahMasuk', 'poinBeredar', 'kategoriSampah'));
    }

    public function storeRedemptionRequest(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melakukan penukaran hadiah.');
        }

        // --- 1. Validasi Manual ---
        $validator = Validator::make($request->all(), [
            'hadiah_id' => 'required|exists:hadiah,id',
        ]);

        if ($validator->fails()) {
            // SweetAlert untuk menampilkan pesan
            Swal::error([
                'title' => 'Hadiah tidak valid',
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonColor' => '#1f2937',
                'timer' => 3000,
            ]);
            return redirect()->back()->with('error', 'Hadiah yang dipilih tidak valid.');
        }

        // --- 2. Pengambilan Data & Pengecekan Kondisi ---
        $hadiah = Hadiah::findOrFail($request->input('hadiah_id'));
        $nasabah = Auth::user(); // User yang sedang login

        // Cek apakah hadiah masih aktif
        if (!$hadiah->is_active) {
            Swal::error([
                'title' => 'Hadiah tidak aktif',
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonColor' => '#1f2937',
                'timer' => 3000,
            ]);
            return redirect()->back()->with('error', 'Hadiah ini sudah tidak tersedia.');
        }

        // Cek ketersediaan stok
        if ($hadiah->stock <= 0) {
            Swal::error([
                'title' => 'Stok Hadiah Habis',
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonColor' => '#1f2937',
                'timer' => 3000,
            ]);
            return redirect()->back()->with('error', 'Maaf, stok hadiah ini sudah habis.');
        }

        // Cek kecukupan poin nasabah
        if ($nasabah->total_poin < $hadiah->point_cost) {
            Swal::error([
                'title' => 'Poin Tidak Cukup',
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonColor' => '#1f2937',
                'timer' => 3000,
            ]);
            return redirect()->back()->with('error', 'Maaf, poin Anda tidak mencukupi untuk menukar hadiah ini.');
        }

        // --- 3. Proses Transaksi Database ---
        try {
            // Gunakan DB Transaction untuk memastikan semua proses berhasil atau semua dibatalkan.
            DB::transaction(function () use ($nasabah, $hadiah) {

                do {
                    $transactionId = 'TRX-' . strtoupper(Str::random(5));
                } while (PenukaranPoin::where('transaction_id', $transactionId)->exists());

                // c. Buat catatan di tabel penukaran_poin
                $penukaran = PenukaranPoin::create([
                    'transaction_id' => $transactionId,
                    'status' => 'diajukan', // Status awal adalah 'diajukan'
                    'points_used' => $hadiah->point_cost,
                    'requested_at' => now(),
                    'nasabah_id' => $nasabah->id,
                    'hadiah_id' => $hadiah->id,
                ]);
                Mail::to(env('MAIL_FROM_ADDRESS'))->send(new HadiahRequested($penukaran));

                if (Auth::user()->hasrole('Operator Padukuhan')) {
                    return redirect()->route('admin.riwayat-penukaran')->with('success', 'Permintaan penukaran hadiah berhasil diajukan! Silakan tunggu persetujuan dari admin.');
                } else {
                    return redirect()->route('nasabah.riwayat-penukaran')->with('success', 'Permintaan penukaran hadiah berhasil diajukan! Silakan tunggu persetujuan dari admin.');
                }
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
            // Jika terjadi error di tengah transaksi, kembalikan dengan pesan gagal.
            Swal::error([
                'title' => 'Terjadi Kesalahan',
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonColor' => '#1f2937',
                'timer' => 3000,
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.');
        }

        // SweetAlert untuk menampilkan pesan sukses
        Swal::success([
            'title' => 'Permintaan Berhasil',
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonColor' => '#1f2937',
            'timer' => 3000,
        ]);

        if (Auth::user()->hasrole('Operator Padukuhan')) {
            return redirect()->route('admin.riwayat-penukaran')->with('success', 'Permintaan penukaran hadiah berhasil diajukan! Silakan tunggu persetujuan dari admin.');
        } else {
            return redirect()->route('nasabah.riwayat-penukaran')->with('success', 'Permintaan penukaran hadiah berhasil diajukan! Silakan tunggu persetujuan dari admin.');
        }
    }

    public function products(ProdukKerajinan $produkKerajinan, Request $request)
    {
        // Memulai query builder untuk produk
        $query = ProdukKerajinan::query();

        // 1. Logika Pencarian berdasarkan nama produk
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 2. Logika Pengurutan (Sorting)
        if ($request->filled('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'latest') {
                $query->latest();
            }
        } else {
            // Urutan default jika tidak ada pilihan
            $query->latest();
        }

        // 3. Paginasi hasil query
        // withQueryString() penting agar parameter filter tetap ada saat berpindah halaman
        $produkKerajinan = $query->paginate(6)->withQueryString();

        return view('front.products', compact('produkKerajinan'));
    }

    public function productDetail(ProdukKerajinan $produk)
    {
        return view('front.product-detail', compact('produk'));
    }

    public function articles(Artikel $artikel)
    {
        // Memulai query builder untuk produk
        $query = Artikel::query();

        // 1. Logika Pencarian berdasarkan judul artikel
        if (request()->filled('search')) {
            $query->where('title', 'like', '%' . request()->search . '%');
        }
        // 2. Logika Pengurutan (Sorting)
        if (request()->filled('sort')) {
            if (request()->sort == 'latest') {
                $query->latest();
            }
        } else {
            // Urutan default jika tidak ada pilihan
            $query->latest();
        }

        // 3. Paginasi hasil query
        // withQueryString() penting agar parameter filter tetap ada saat berpindah halaman
        $kontenArtikel = $query->paginate(6)->withQueryString();

        return view('front.articles', compact('kontenArtikel'));
    }

    public function articleDetail(Artikel $artikel)
    {
        $recentArticles = Artikel::where('id', '!=', $artikel->id)->latest()->paginate(5);
        return view('front.article-detail', compact('artikel', 'recentArticles'));
    }

    public function rewards(Hadiah $hadiahPoin)
    {
        // Memulai query builder untuk hadiah poin
        $query = Hadiah::query();

        // 1. Logika Pencarian berdasarkan nama hadiah
        if (request()->filled('search')) {
            $query->where('name', 'like', '%' . request()->search . '%');
        }

        // 2. Logika Pengurutan (Sorting)
        if (request()->filled('sort')) {
            if (request()->sort == 'latest') {
                $query->latest();
            }
        } else {
            // Urutan default jika tidak ada pilihan
            $query->latest();
        }
        // 3. Paginasi hasil query
        // withQueryString() penting agar parameter filter tetap ada saat berpindah halaman
        $hadiahPoin = $query->where('is_active', true)->where('stock', '>', 0)->paginate(6)->withQueryString();

        return view('front.rewards', compact('hadiahPoin'));
    }

    public function bank(DirektoriBankSampah $lokasiBankSampah)
    {
        // Memulai query builder untuk lokasi bank sampah
        $query = DirektoriBankSampah::query();

        // 1. Logika Pencarian berdasarkan nama bank sampah
        if (request()->filled('search')) {
            $query->where('name', 'like', '%' . request()->search . '%');
        }

        // 2. Logika Pengurutan (Sorting)
        if (request()->filled('sort')) {
            if (request()->sort == 'latest') {
                $query->latest();
            }
        } else {
            // Urutan default jika tidak ada pilihan
            $query->latest();
        }

        $lokasiBankSampah = $query->paginate(6)->withQueryString();

        return view('front.bank', compact('lokasiBankSampah'));
    }

    function bankDetail(DirektoriBankSampah $bank)
    {
        return view('front.bank-detail', compact('bank'));
    }

    function category(KategoriSampah $kategoriSampah)
    {
        $query = KategoriSampah::query();

        // 1. Logika Pencarian berdasarkan nama kategori sampah
        if (request()->filled('search')) {
            $query->where('name', 'like', '%' . request()->search . '%');
        }

        // 2. Logika Pengurutan (Sorting)
        if (request()->filled('sort')) {
            if (request()->sort == 'latest') {
                $query->latest();
            }
        } else {
            // Urutan default jika tidak ada pilihan
            $query->latest();
        }

        $kategoriSampah = $query->paginate(6)->withQueryString();

        return view('front.category', compact('kategoriSampah'));
    }
}
