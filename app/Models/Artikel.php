<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Artikel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'artikel';

    protected $fillable = [
        'title',
        'slug',
        'author_name',
        'excerpt',
        'content',
        'published_at',
        'image_url',
        'is_active',
        'input_by_user_id',
    ];

    /**
     * The "booted" method of the model.
     *
     * Ini akan dijalankan secara otomatis oleh Laravel.
     */
    
    protected static function booted(): void
    {
        // Event ini berjalan setiap kali model 'Artikel' akan dibuat (creating).
        static::creating(function (Artikel $artikel) {
            // Jika slug belum diisi, buat dari title
            if (empty($artikel->slug)) {
                $slug = Str::slug($artikel->title);
                $originalSlug = $slug;
                $counter = 1;
                // Cek jika slug sudah ada, tambahkan angka di belakangnya
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }
                $artikel->slug = $slug;
            }

            // Otomatis isi user yang sedang login
            if (Auth::check()) {
                $artikel->input_by_user_id = Auth::id();
            }
        });
    }

    /**
     * Definisikan relasi ke user yang menginput
     */
    public function inputBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'input_by_user_id');
    }
}
