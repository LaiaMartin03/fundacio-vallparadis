<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Professional extends Model
{
    protected $table = 'users';
    protected $fillable = ['email','name','password','locker','code','info_id','active','cv_file_path','cv_original_filename','profile_photo_path','profile_photo_original_filename'];
    
    public function resources()
    {
        return $this->hasMany(Resource::class, 'user_id');
    }

    public function givenResources()
    {
        return $this->hasMany(Resource::class, 'given_by_user_id');
    }

    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(
            Curso::class,
            'learning_program', 
            'user_id',          
            'curso_id'
        );
    }

    public function learningPrograms(): HasMany
    {
        return $this->hasMany(LearningProgram::class, 'user_id');
    }
}

