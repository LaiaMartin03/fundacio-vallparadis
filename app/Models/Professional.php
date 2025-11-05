<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = 'users';
    protected $fillable = ['email','name','password','locker','code','info_id','active'];
    
    public function resources()
    {
        return $this->hasMany(Resource::class, 'user_id');
    }

    public function givenResources()
    {
        return $this->hasMany(Resource::class, 'given_by_user_id');
    }

    public function cursos() {
        return $this->belongsToMany(Curso::class, 'learning_programs', 'user_id', 'curso_id');
    }
}

