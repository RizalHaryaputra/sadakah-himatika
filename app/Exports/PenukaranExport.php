<?php

namespace App\Exports;

use App\Models\PenukaranPoin; // Sesuaikan dengan namespace model Anda
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenukaranExport implements FromQuery, WithHeadings, WithMapping
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
        // Query dasar, mengambil relasi yang dibutuhkan untuk efisiensi
        $query = PenukaranPoin::with('nasabah', 'hadiah');

        // Terapkan filter pencarian jika ada
        if ($this->search) {
            $query->where('transaction_id', 'like', "%{$this->search}%");
        }

        // Urutkan berdasarkan data yang terbaru
        return $query->latest('requested_at');
    }

    /**
     * Mendefinisikan header untuk setiap kolom di file Excel.
     */
    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nama Nasabah',
            'Email Nasabah',
            'Nama Hadiah',
            'Poin Digunakan',
            'Status',
            'Catatan',
            'Tanggal Diajukan',
            'Tanggal Disetujui',
            'Tanggal Ditolak',
            'Tanggal Diambil',
        ];
    }

    /**
     * Memetakan data dari setiap baris hasil query ke kolom yang sesuai.
     * @param \App\Models\PenukaranPoin $penukaran
     */
    public function map($penukaran): array
    {
        return [
            $penukaran->transaction_id,
            $penukaran->nasabah->name,
            $penukaran->nasabah->email,
            $penukaran->hadiah->name,
            $penukaran->points_used,
            ucfirst($penukaran->status), // Mengubah status menjadi Huruf Kapital di awal
            $penukaran->notes,
            optional($penukaran)->requested_at ?? '-',
            optional($penukaran)->approve_at ?? '-',
            optional($penukaran)->rejected_at ?? '-',
            optional($penukaran)->collected_at ?? '-',
        ];
    }
}