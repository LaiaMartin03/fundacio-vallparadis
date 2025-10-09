<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uniform extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'given_by_user_id',
        'user_id',
        'shirt_size',
        'pants_size',
        'lab_coat',
        'shoe_size',
        'delivery_at',
    ];
}
