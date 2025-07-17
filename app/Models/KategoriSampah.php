<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriSampah extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'kategori_sampah';
    protected $fillable = [
        'name',
        'price_per_kg',
        'points_per_kg',
        'description',
    ];
}
