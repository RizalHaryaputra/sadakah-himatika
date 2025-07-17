<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukKerajinan extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'produk_kerajinan';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image_url',
        'seller_name',
        'whatsapp_number',
        'is_active',
    ];
}
