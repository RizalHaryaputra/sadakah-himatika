<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Padukuhan extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'padukuhan';
    protected $fillable = [
        'name',
        'description'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
