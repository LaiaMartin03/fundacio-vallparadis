<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // relación many-to-many con Curso vía learning_program
    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(
            Curso::class,
            'learning_program', // tabla intermedia
            'user_id',          // FK en learning_program hacia users (professional)
            'curso_id'          // FK en learning_program hacia curso
        );
    }

    // opcional: relación hacia registros de la tabla intermedia
    public function learningPrograms(): HasMany
    {
        return $this->hasMany(LearningProgram::class, 'user_id');
    }
}

