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
        'type',
        'info',
        'assistent',
        'start_date',
        'finish_date',
        'certification',
        'active'
    ];

    // relación many-to-many con Professional usando la tabla intermedia learning_program
    public function professionals(): BelongsToMany
    {
        return $this->belongsToMany(
            Professional::class,
            'learning_program', // tabla intermedia
            'curso_id',         // FK en learning_program hacia curso
            'user_id'           // FK en learning_program hacia users (professional)
        );
    }

    // opcional: relación hacia registros de la tabla intermedia
    public function learningPrograms(): HasMany
    {
        return $this->hasMany(LearningProgram::class, 'curso_id');
    }
}
