<?php

namespace App\Exports;

use App\Models\SetoranSampah;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SetoranExport implements FromQuery, WithHeadings, WithMapping
{
    protected $search;

    /**
     * Menerima parameter pencarian dari controller.
     */
    public function __construct($search)
    {
        $this->search = $search;
    }

    /**
     * Mendefinisikan query Eloquent untuk data yang akan diekspor.
     * Logika query ini harus sama dengan method index di controller Anda.
     */
    public function query()
    {
        $pengguna = Auth::user();
        $query = SetoranSampah::with('nasabah.padukuhan', 'kategoriSampah');

        // Filter berdasarkan peran operator
        if ($pengguna->hasRole('Operator Padukuhan')) {
            $query->whereHas('nasabah', function ($q) use ($pengguna) {
                $q->where('padukuhan_id', $pengguna->padukuhan_id);
            });
        }

        // Filter berdasarkan keyword pencarian
        if ($this->search) {
            $query->whereHas('nasabah', function ($q) {
                $q->where('name', 'like', "%{$this->search}%");
            });
        }

        return $query->latest('collection_date');
    }

    /**
     * Mendefinisikan header untuk setiap kolom di file Excel.
     */
    public function headings(): array
    {
        return [
            'ID Setoran',
            'Nama Nasabah',
            'Email Nasabah',
            'Padukuhan',
            'Kategori Sampah',
            'Berat (Kg)',
            'Poin Operator',
            'Poin Nasabah',
            'Tanggal Setor',
        ];
    }

    /**
     * Memetakan data dari setiap baris hasil query ke kolom yang sesuai.
     * @param \App\Models\SetoranSampah $setoran
     */
    public function map($setoran): array
    {
        $totalPoin = floor($setoran->points_earned * 100 / 90);
        $operatorPoin = floor($totalPoin * 0.10);

        return [
            $setoran->id,
            $setoran->nasabah->name,
            $setoran->nasabah->email,
            optional($setoran->nasabah->padukuhan)->name ?? '-',
            $setoran->kategoriSampah->name,
            $setoran->weight_kg,
            $operatorPoin,
            $setoran->points_earned,
            $setoran->collection_date,
        ];
    }
}
