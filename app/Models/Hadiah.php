<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hadiah extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'hadiah';
    protected $fillable = [
        'name',
        'description',
        'point_cost',
        'stock',
        'image_url',
        'is_active'
    ];
}
