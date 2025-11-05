<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
