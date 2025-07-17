<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'total_poin',
        'padukuhan_id',
        'phone_number',
        'address',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: Satu user dimiliki oleh satu padukuhan
    public function padukuhan(): BelongsTo
    {
        return $this->belongsTo(Padukuhan::class);
    }

    // Relasi: Satu user (nasabah) bisa melakukan banyak setoran sampah
    public function setoranSampah(): HasMany
    {
        return $this->hasMany(SetoranSampah::class, 'nasabah_id');
    }

    // Relasi: Satu user (nasabah) bisa melakukan banyak penukaran poin
    public function penukaranPoin(): HasMany
    {
        return $this->hasMany(PenukaranPoin::class, 'nasabah_id');
    }
}
