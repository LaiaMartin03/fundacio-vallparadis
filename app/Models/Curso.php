<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    protected $table = 'curso';

    protected $fillable = [
        'name',
        'forcem',
        'hours',
        'modality',
        'type',
        'info',
        'assistent',
        'start_date',
        'finish_date',
        'certification',
        'active'
    ];

    public function professionals(): BelongsToMany
    {
        return $this->belongsToMany(
            Professional::class,
            'learning_program', 
            'curso_id',        
            'user_id'          
        );
    }

    public function learningPrograms(): HasMany
    {
        return $this->hasMany(LearningProgram::class, 'curso_id');
    }
}
