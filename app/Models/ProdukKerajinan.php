<?php

    namespace App\Models;

    use Illuminate\Support\Str;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class ProdukKerajinan extends Model
    {
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

        /**
         * The "booted" method of the model.
         * Secara otomatis membuat slug saat produk baru dibuat.
         */
        protected static function booted(): void
        {
            static::creating(function (ProdukKerajinan $produk) {
                // Membuat slug otomatis jika belum ada
                if (empty($produk->slug)) {
                    $slug = Str::slug($produk->name);
                    $originalSlug = $slug;
                    $counter = 1;
                    while (static::where('slug', $slug)->exists()) {
                        $slug = $originalSlug . '-' . $counter++;
                    }
                    $produk->slug = $slug;
                }
            });
        }
    }
