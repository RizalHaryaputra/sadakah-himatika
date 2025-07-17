<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetoranSampah extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'setoran_sampah';
    protected $fillable = [
        'weight_kg',
        'points_earned',
        'collection_date',
        'notes',
        'nasabah_id',
        'operator_id',
        'kategori_sampah_id'
    ];

     // Relasi ke nasabah (user)
    public function nasabah(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nasabah_id');
    }

    // Relasi ke operator (user)
    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    // Relasi ke kategori sampah
    public function kategoriSampah(): BelongsTo
    {
        return $this->belongsTo(KategoriSampah::class);
    }
}
