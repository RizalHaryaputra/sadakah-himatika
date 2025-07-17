<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenukaranPoin extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'penukaran_poin';
    protected $fillable = [
        'transaction_id',
        'status',
        'points_used',
        'notes',
        'requested_at',
        'approved_at',
        'rejected_at',
        'nasabah_id',
        'hadiah_id',
        'admin_id',
    ];

    // Relasi ke nasabah (user)
    public function nasabah(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nasabah_id');
    }

    // Relasi ke hadiah
    public function hadiah(): BelongsTo
    {
        return $this->belongsTo(Hadiah::class);
    }

    // Relasi ke admin yang memproses (user)
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
