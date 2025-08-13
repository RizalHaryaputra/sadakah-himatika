<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PenukaranPoin;
use App\Models\SetoranSampah;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        // --- 1. Data untuk Kartu Statistik ---
        $totalNasabah = User::whereHas('roles', fn($q) => $q->where('name', 'Nasabah'))->count();
        $totalSampahMasuk = SetoranSampah::sum('weight_kg');
        $totalTransaksi = SetoranSampah::count() + PenukaranPoin::count();
        $poinBeredar = User::whereHas('roles', fn($q) => $q->where('name', 'Nasabah'))->sum('total_poin');

        // --- 2. Data untuk Grafik Volume Sampah (6 Bulan Terakhir) ---
        $volumeSampah = SetoranSampah::select(
            DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'),
            DB::raw('SUM(weight_kg) as total_berat')
        )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')->orderBy('month', 'asc')
            ->get();

        $chartLabels = [];
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $chartLabels[] = $month->translatedFormat('F'); // e.g., "Agustus"
            $dataPoint = $volumeSampah->first(function ($item) use ($month) {
                return $item->year == $month->year && $item->month == $month->month;
            });
            $chartData[] = $dataPoint ? $dataPoint->total_berat : 0;
        }

        // --- 3. Data untuk Komposisi Sampah (Pie Chart) ---
        $komposisiSampah = SetoranSampah::join('kategori_sampah', 'setoran_sampah.kategori_sampah_id', '=', 'kategori_sampah.id')
            ->select('kategori_sampah.name', DB::raw('SUM(setoran_sampah.weight_kg) as total_berat'))
            ->groupBy('kategori_sampah.name')
            ->orderBy('total_berat', 'desc')
            ->limit(5)
            ->get();

        $pieChartLabels = $komposisiSampah->pluck('name');
        $pieChartData = $komposisiSampah->pluck('total_berat');

        // --- 4. Data untuk Statistik Sampah per Padukuhan (Bar Chart) ---
        $statistikPadukuhan = SetoranSampah::join('users', 'setoran_sampah.nasabah_id', '=', 'users.id')
            ->join('padukuhan', 'users.padukuhan_id', '=', 'padukuhan.id')
            ->select('padukuhan.name', DB::raw('SUM(setoran_sampah.weight_kg) as total_berat'))
            ->groupBy('padukuhan.name')
            ->orderBy('total_berat', 'desc')
            ->get();

        $padukuhanChartLabels = $statistikPadukuhan->pluck('name');
        $padukuhanChartData = $statistikPadukuhan->pluck('total_berat');


        // --- 5. Data untuk Aktivitas Terbaru ---
        $penukaranMenunggu = PenukaranPoin::with('nasabah', 'hadiah')
            ->where('status', 'diajukan')
            ->latest('requested_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard.admin', compact(
            'totalNasabah',
            'totalSampahMasuk',
            'totalTransaksi',
            'poinBeredar',
            'chartLabels',
            'chartData',
            'pieChartLabels',
            'pieChartData',
            'penukaranMenunggu',
            'padukuhanChartLabels',
            'padukuhanChartData'
        )); // Return view with all data
    }
}
