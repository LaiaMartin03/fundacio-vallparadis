<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = 'users';
    protected $fillable = ['email','name','password','locker','code','info_id','active',];
}