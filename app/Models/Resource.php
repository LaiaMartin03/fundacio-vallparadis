<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'shirt_size',
        'pants_size',
        'lab_coat',
        'shoe_size',
        'user_id',
        'given_by_user_id',
        'delivered_at',

    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'user_id');
    }

    public function givenBy()
    {
        return $this->belongsTo(Professional::class, 'given_by_user_id');
    }
}
