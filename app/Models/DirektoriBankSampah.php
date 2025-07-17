<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirektoriBankSampah extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'direktori_bank_sampah';
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'operation_hours',
        'slug',
        'address',
        'maps_embed',
        'contact_person',
        'phone_number',
    ];
}
