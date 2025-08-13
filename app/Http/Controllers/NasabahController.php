<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Padukuhan;
use App\Models\PenukaranPoin;
use App\Models\SetoranSampah;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use SweetAlert2\Laravel\Swal;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class NasabahController extends Controller
{
    //
    private const DEFAULT_IMAGE = 'profile_pictures/profile.png';

    public function index()
    {
        $user = Auth::user();

        // --- 1. Data untuk Kartu Statistik ---
        // Ganti dengan logika Anda yang sebenarnya
        $totalPoin = $user->total_poin ?? 0;
        $totalBerat = SetoranSampah::where('nasabah_id', $user->id)->sum('weight_kg');
        $totalSetoran = SetoranSampah::where('nasabah_id', $user->id)->count();
        $totalPenukaran = PenukaranPoin::where('nasabah_id', $user->id)->count();

        // --- 2. Data untuk Grafik Tren Setoran ---
        $chartData = $this->getSetoranChartData($user->id);

        // --- 3. Data untuk Aktivitas Terbaru ---
        $setoranTerbaru = SetoranSampah::where('nasabah_id', $user->id)
            ->latest()
            ->take(3)
            ->get();

        $penukaranTerbaru = PenukaranPoin::where('nasabah_id', $user->id)
            ->latest()
            ->take(3)
            ->get();

        return view('nasabah.dashboard', [
            'totalPoin' => $totalPoin,
            'totalBerat' => $totalBerat,
            'totalSetoran' => $totalSetoran,
            'totalPenukaran' => $totalPenukaran,
            'chartLabels' => $chartData['labels'],
            'chartData' => $chartData['data'],
            'setoranTerbaru' => $setoranTerbaru,
            'penukaranTerbaru' => $penukaranTerbaru,
        ]);
    }

    /**
     * Private method untuk mengambil dan memformat data setoran 6 bulan terakhir.
     *
     * @param int $userId
     * @return array
     */
    private function getSetoranChartData(int $userId): array
    {
        $setoranData = SetoranSampah::select(
            // Mengambil tahun dan bulan dari created_at
            DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'),
            // Menjumlahkan berat untuk setiap grup bulan
            DB::raw('SUM(weight_kg) as total_berat')
        )
            ->where('nasabah_id', $userId)
            // Mengambil data hanya dari 6 bulan terakhir
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();



        $labels = [];
        $data = [];

        // Inisialisasi data untuk 6 bulan terakhir dengan nilai 0
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            // Format label menjadi "Jan", "Feb", dst.
            $labels[] = $month->translatedFormat('M');
            $data[$month->format('Y-m')] = 0;
        }

        // Isi data dari hasil query database
        foreach ($setoranData as $setoran) {
            $date = Carbon::createFromDate($setoran->year, $setoran->month, 1);
            $key = $date->format('Y-m');
            if (isset($data[$key])) {
                $data[$key] = $setoran->total_berat;
            }
        }

        return [
            'labels' => $labels,
            // Mengambil hanya nilai dari array asosiatif
            'data' => array_values($data),
        ];
    }

    public function profile()
    {
        // Logika untuk menampilkan profil nasabah
        $pengguna = Auth::user();
        if ($pengguna->hasRole('Nasabah')) {
            return view('nasabah.profile', compact('pengguna'));
        } else {
            return redirect()->route('nasabah.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function edit(User $pengguna)
    {
        $roles = Role::pluck('name', 'name');
        $padukuhan = Padukuhan::pluck('name', 'id');
        return view('nasabah.edit-profile', compact('pengguna', 'roles', 'padukuhan'));
    }

    public function update(UpdateUserRequest $request, User $pengguna)
    {
        $validated = $request->validated();

        // Hanya update password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $this->handleImageUpload($request, $pengguna->profile_picture);
        }

        $pengguna->update($validated);
        $pengguna->syncRoles($validated['role']);

        // Menggunakan SweetAlert untuk menampilkan pesan sukses
        Swal::toastSuccess([
            'title' => 'Profil berhasil diperbarui',
            'position' => 'bottom-end',
            'showConfirmButton' => false,
            'width' => 'auto',
            'timer' => 3000,
        ]);
        return redirect()->route('nasabah.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    private function handleImageUpload($request, $oldImagePath = null): string
    {
        if ($request->hasFile('profile_picture')) {
            if ($oldImagePath && $oldImagePath !== self::DEFAULT_IMAGE) {
                Storage::disk('public')->delete($oldImagePath);
            }
            return $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        return $oldImagePath ?? self::DEFAULT_IMAGE;
    }

    public function riwayatPenukaran(Request $request)
    {
        // Logika untuk menampilkan riwayat penukaran poin nasabah
        $user = Auth::user();
        if ($user->hasRole('Nasabah')) {
            $query = PenukaranPoin::where('nasabah_id', $user->id)
                ->with(['hadiah', 'admin']);

            if ($request->filled('search')) {
                $query->where('transaction_id', 'like', '%' . $request->search . '%');
            } else {
                $query->latest();
            }

            $penukaranPoin = $query->paginate(5)->withQueryString();

            return view('nasabah.riwayat-penukaran', compact('penukaranPoin'));
        }
    }

    public function riwayatSetoran(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('Nasabah')) {
            // Buat query dasar untuk nasabah ini
            $query = SetoranSampah::where('nasabah_id', $user->id);

            // Tambahkan filter pencarian berdasarkan collection_date jika ada input
            if ($request->filled('search')) {
                $query->where('collection_date', 'like', '%' . $request->search . '%');
            }

            // Urutkan berdasarkan waktu terbaru
            $setoranSampah = $query->latest()->paginate(5)->withQueryString();

            return view('nasabah.riwayat-setoran', compact('setoranSampah'));
        }

        abort(403); // Jika bukan nasabah, tolak akses
    }

    public function cancel(PenukaranPoin $penukaranPoin)
    {
        // Logika untuk membatalkan penukaran poin
        if (Auth::user()->id !== $penukaranPoin->nasabah_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membatalkan penukaran ini.');
        }

        $penukaranPoin->delete();

        return redirect()->route('nasabah.riwayat-penukaran')->with('success', 'Penukaran poin berhasil dibatalkan.');
    }
}
