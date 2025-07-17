<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    //
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
        'input_by_user_id'
    ];

     // Relasi ke user yang menginput
    public function inputBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'input_by_user_id');
    }
}
