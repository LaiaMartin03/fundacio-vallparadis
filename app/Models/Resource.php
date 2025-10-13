<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'uniform_id',
        'user_id',
        'given_by_user_id',
        'delivered_at',
    ];
}
