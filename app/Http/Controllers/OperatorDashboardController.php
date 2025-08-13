<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PenukaranPoin;
use App\Models\SetoranSampah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OperatorDashboardController extends Controller
{
    public function index()
    {
        $operator = Auth::user();
        $padukuhanId = $operator->padukuhan_id;

        // Jika operator tidak terhubung ke padukuhan, kembalikan error atau redirect
        if (!$padukuhanId) {
            // Anda bisa menambahkan notifikasi error di sini
            return redirect()->route('dashboard')->with('error', 'Akun Anda tidak terhubung ke padukuhan manapun.');
        }

        $padukuhanNama = $operator->padukuhan->name;

        // --- 1. Data untuk Kartu Statistik ---
        $totalNasabah = User::where('padukuhan_id', $padukuhanId)
            ->whereHas('roles', fn($q) => $q->where('name', 'Nasabah'))
            ->count();
            
        $totalSampahMasuk = SetoranSampah::whereHas('nasabah', fn($q) => $q->where('padukuhan_id', $padukuhanId))
            ->sum('weight_kg');

        $setoranHariIni = SetoranSampah::whereHas('nasabah', fn($q) => $q->where('padukuhan_id', $padukuhanId))
            ->whereDate('created_at', Carbon::today())
            ->count();

        // --- 2. Data untuk Grafik Tren Setoran (7 Hari Terakhir) ---
        $setoranTerakhir = SetoranSampah::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('COUNT(*) as jumlah_setoran')
            )
            ->whereHas('nasabah', fn($q) => $q->where('padukuhan_id', $padukuhanId))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
        
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->translatedFormat('d M'); // e.g., "01 Agu"
            $dataPoint = $setoranTerakhir->first(function ($item) use ($date) {
                return Carbon::parse($item->tanggal)->isSameDay($date);
            });
            $chartData[] = $dataPoint ? $dataPoint->jumlah_setoran : 0;
        }

        // --- 3. Data untuk Grafik Volume Sampah Bulanan (6 Bulan Terakhir) ---
        $volumeBulanan = SetoranSampah::select(
                DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'),
                DB::raw('SUM(weight_kg) as total_berat')
            )
            ->whereHas('nasabah', fn($q) => $q->where('padukuhan_id', $padukuhanId))
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')->orderBy('month', 'asc')
            ->get();

        $bulananChartLabels = [];
        $bulananChartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $bulananChartLabels[] = $month->translatedFormat('F');
            $dataPoint = $volumeBulanan->first(fn($item) => $item->year == $month->year && $item->month == $month->month);
            $bulananChartData[] = $dataPoint ? $dataPoint->total_berat : 0;
        }

        // --- 4. Data untuk Komposisi Sampah (Pie Chart) ---
        $komposisiSampah = SetoranSampah::join('kategori_sampah', 'setoran_sampah.kategori_sampah_id', '=', 'kategori_sampah.id')
            ->select('kategori_sampah.name', DB::raw('SUM(setoran_sampah.weight_kg) as total_berat'))
            ->whereHas('nasabah', fn($q) => $q->where('padukuhan_id', $padukuhanId))
            ->groupBy('kategori_sampah.name')
            ->orderBy('total_berat', 'desc')
            ->limit(5)
            ->get();
            
        $pieChartLabels = $komposisiSampah->pluck('name');
        $pieChartData = $komposisiSampah->pluck('total_berat');

        // --- 5. Data untuk Tabel Setoran Terbaru ---
        $setoranTerbaru = SetoranSampah::with(['nasabah', 'kategoriSampah'])
            ->whereHas('nasabah', fn($q) => $q->where('padukuhan_id', $padukuhanId))
            ->latest()
            ->limit(5)
            ->get();

        $totalPoin = $operator->total_poin;

        return view('admin.dashboard.operator', compact(
            'padukuhanNama',
            'totalNasabah',
            'totalSampahMasuk',
            'setoranHariIni',
            'chartLabels',
            'chartData',
            'setoranTerbaru',
            'bulananChartLabels',
            'bulananChartData',
            'pieChartLabels',
            'pieChartData',
            'totalPoin'
        )); 
    }

    public function riwayatPenukaran(Request $request)
    {
        // Logika untuk menampilkan riwayat penukaran poin nasabah
        $user = Auth::user();
        if ($user->hasRole('Operator Padukuhan')) {
            $query = PenukaranPoin::where('nasabah_id', $user->id)
                ->with(['hadiah', 'admin']);

            if ($request->filled('search')) {
                $query->where('transaction_id', 'like', '%' . $request->search . '%');
            } else {
                $query->latest();
            }

            $penukaranPoin = $query->paginate(5)->withQueryString();

            return view('admin.dashboard.riwayat-penukaran', compact('penukaranPoin'));
        }
    }
}
