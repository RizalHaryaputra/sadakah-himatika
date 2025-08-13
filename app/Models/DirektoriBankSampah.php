<?php

namespace App\Models;

use Illuminate\Support\Str;
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

    /**
     * The "booted" method of the model.
     * Otomatis membuat slug saat data baru dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function (DirektoriBankSampah $lokasi) {
            if (empty($lokasi->slug)) {
                $slug = Str::slug($lokasi->name);
                $originalSlug = $slug;
                $counter = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }
                $lokasi->slug = $slug;
            }
        });
    }
}
