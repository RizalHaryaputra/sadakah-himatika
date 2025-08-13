<?php

namespace App\Http\Controllers;

use App\Exports\PenukaranExport;
use App\Mail\PenukaranDiambilMail;
use App\Mail\PenukaranDisetujuiMail;
use App\Mail\PenukaranDitolakMail;
use App\Models\PenukaranPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use SweetAlert2\Laravel\Swal;

class PenukaranPoinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PenukaranPoin::with(['nasabah', 'hadiah', 'admin']);

        if ($request->filled('search')) {
            $query->whereHas('nasabah', function ($q) use ($request) {
                $q->where('transaction_id', 'like', '%' . $request->search . '%');
            });
        } else {
            $query->latest();
        }

        $penukaranPoin = $query->paginate(5)->withQueryString();

        return view('admin.penukaran.index', compact('penukaranPoin'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PenukaranPoin $penukaranPoin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenukaranPoin $penukaranPoin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenukaranPoin $penukaranPoin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenukaranPoin $penukaranPoin)
    {
        //
    }

    /**
     * Menyetujui permintaan penukaran poin.
     */
    public function approve(Request $request, PenukaranPoin $penukaranPoin)
    {
        // Pastikan hanya Super Admin yang bisa melakukan aksi ini
        if (!Auth::user()->hasRole('Super Admin')) {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        // --- Pengecekan Kondisi Sebelum Approve ---
        // 1. Pastikan status masih 'diajukan'
        if ($penukaranPoin->status !== 'diajukan') {
            return redirect()->back()->with('error', 'Permintaan ini sudah diproses sebelumnya.');
        }

        $nasabah = $penukaranPoin->nasabah;
        $hadiah = $penukaranPoin->hadiah;

        // 2. Cek ulang ketersediaan stok
        if ($hadiah->stock < 1) {
            // Jika stok habis, otomatis tolak permintaan
            $penukaranPoin->update([
                'status' => 'ditolak',
                'rejected_at' => now(),
                'admin_id' => Auth::id(),
                'notes' => 'Ditolak otomatis karena stok habis saat akan disetujui.',
            ]);
            // SweetAlert untuk menampilkan pesan
            Swal::error([
                'title' => 'Ditolak Otomatis',
                'text' => 'Stok hadiah sudah habis saat akan disetujui.',
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonColor' => '#1f2937',
                'timer' => 3000,
            ]);
            return redirect()->back()->with('error', 'Gagal menyetujui: Stok hadiah sudah habis.');
        }

        // 3. Cek hadiah masih aktif
        if (!$hadiah->is_active) {
            // Jika hadiah tidak aktif, otomatis tolak permintaan
            $penukaranPoin->update([
                'status' => 'ditolak',
                'rejected_at' => now(),
                'admin_id' => Auth::id(),
                'notes' => 'Ditolak otomatis karena hadiah tidak aktif saat akan disetujui.',
            ]);
            // SweetAlert untuk menampilkan pesan
            Swal::error([
                'title' => 'Ditolak Otomatis',
                'text' => 'Hadiah tidak aktif saat akan disetujui.',
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonColor' => '#1f2937',
                'timer' => 3000,
            ]);
            return redirect()->back()->with('error', 'Gagal menyetujui: Hadiah tidak aktif.');
        }

        // 4. Cek ulang kecukupan poin nasabah
        if ($nasabah->total_poin < $penukaranPoin->points_used) {
            // Jika poin tidak cukup, otomatis tolak permintaan
            $penukaranPoin->update([
                'status' => 'ditolak',
                'rejected_at' => now(),
                'admin_id' => Auth::id(),
                'notes' => 'Ditolak otomatis karena poin nasabah tidak cukup saat akan disetujui.',
            ]);
            // SweetAlert untuk menampilkan pesan
            Swal::error([
                'title' => 'Ditolak Otomatis',
                'text' => 'Poin nasabah tidak lagi mencukupi.',
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonColor' => '#1f2937',
                'timer' => 3000,
            ]);
            return redirect()->back()->with('error', 'Gagal menyetujui: Poin nasabah tidak lagi mencukupi.');
        }

        // --- Proses Transaksi Database ---
        try {
            DB::transaction(function () use ($request, $penukaranPoin, $nasabah, $hadiah) {
                // a. Kurangi poin nasabah
                $nasabah->decrement('total_poin', $penukaranPoin->points_used);

                // b. Kurangi stok hadiah
                $hadiah->decrement('stock');

                // c. Update status permintaan menjadi 'disetujui'
                $penukaranPoin->update([
                    'status' => 'disetujui',
                    'approved_at' => now(),
                    'admin_id' => Auth::id(), // ID admin yang menyetujui
                    'notes' => $request->input('notes', 'Disetujui Admin'), // Ambil catatan dari form jika ada
                ]);

                Mail::to($nasabah->email)->send(new PenukaranDisetujuiMail($penukaranPoin));
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses persetujuan.');
        }

        // SweetAlert untuk menampilkan pesan
        Swal::toastSuccess([
            'title' => 'Permintaan berhasil disetujui',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);

        return redirect()->route('admin.penukaran.index')->with('success', 'Permintaan penukaran poin berhasil disetujui.');
    }

    /**
     * Menolak permintaan penukaran poin.
     */
    public function reject(Request $request, PenukaranPoin $penukaranPoin)
    {
        // Pastikan hanya Super Admin yang bisa melakukan aksi ini
        if (!Auth::user()->hasRole('Super Admin')) {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        // Pastikan status masih 'diajukan'
        if ($penukaranPoin->status !== 'diajukan') {
            return redirect()->back()->with('error', 'Permintaan ini sudah diproses sebelumnya.');
        }

        // Update status menjadi 'ditolak'
        $penukaranPoin->update([
            'status' => 'ditolak',
            'rejected_at' => now(),
            'admin_id' => Auth::id(),
            'notes' => $request->input('notes', 'Ditolak Admin'), // Ambil alasan dari form jika ada
        ]);

        Mail::to($penukaranPoin->nasabah->email)->send(new PenukaranDitolakMail($penukaranPoin));

        // SweetAlert untuk menampilkan pesan
        Swal::toastSuccess([
            'title' => 'Permintaan Berhasil Ditolak',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.penukaran.index')->with('success', 'Permintaan penukaran poin telah ditolak.');
    }

    public function markCollected(PenukaranPoin $penukaranPoin)
    {
        // Pastikan hanya Super Admin yang bisa melakukan aksi ini
        if (!Auth::user()->hasRole('Super Admin')) {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        // Pastikan status masih 'disetujui'
        if ($penukaranPoin->status !== 'disetujui') {
            return redirect()->back()->with('error', 'Permintaan ini belum disetujui.');
        }


        // Update status menjadi 'collected'
        $penukaranPoin->update([
            'status' => 'diambil',
            'claimed_at' => now(),
            'admin_id' => Auth::id(),
        ]);

        Mail::to($penukaranPoin->nasabah->email)->send(new PenukaranDiambilMail($penukaranPoin));



        // SweetAlert untuk menampilkan pesan
        Swal::toastSuccess([
            'title' => 'Hadiah Berhasil Diambil',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('admin.penukaran.index')->with('success', 'Hadiah berhasil diambil.');
    }

    public function export(Request $request)
    {
        // Ambil keyword pencarian dari request
        $search = $request->input('search');

        // Buat nama file yang dinamis dengan tanggal hari ini
        $fileName = 'data-penukaran-poin-' . date('Y-m-d') . '.xlsx';

        // Panggil class PenukaranExport, kirim parameter pencarian, dan unduh filenya
        return Excel::download(new PenukaranExport($search), $fileName);
    }
}
