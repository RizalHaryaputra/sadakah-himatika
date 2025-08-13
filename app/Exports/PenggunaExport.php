<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenggunaExport implements FromQuery, WithHeadings, WithMapping
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

        // Mulai dengan query dasar, mengambil relasi yang dibutuhkan
        $query = User::with('padukuhan', 'roles');

        // Terapkan filter berdasarkan peran pengguna yang login
        if ($pengguna->hasRole('Super Admin')) {
            // Super Admin bisa melihat semua pengguna, kecuali dirinya sendiri
            $query->where('id', '!=', $pengguna->id);
        } elseif ($pengguna->hasRole('Operator Padukuhan')) {
            // Operator hanya bisa melihat pengguna dengan peran 'Nasabah'
            // dan yang berada di padukuhan yang sama dengannya.
            $query->where('padukuhan_id', $pengguna->padukuhan_id)
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'Nasabah');
                });
        }

        // Terapkan filter pencarian jika ada
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            });
        }

        return $query->latest();
    }

    /**
     * Mendefinisikan header untuk setiap kolom di file Excel.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Peran',
            'Alamat',
            'Padukuhan',
            'Total Poin',
            'Tanggal Terdaftar',
        ];
    }

    /**
     * Memetakan data dari setiap baris hasil query ke kolom yang sesuai.
     * @param \App\Models\User $user
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            // Mengambil nama peran pertama yang dimiliki pengguna
            $user->getRoleNames()->first() ?? 'Tidak ada peran',
            $user->address,
            optional($user->padukuhan)->name ?? '-',
            $user->total_poin,
            $user->created_at->format('Y-m-d H:i:s'),
        ]; 
    }
}
