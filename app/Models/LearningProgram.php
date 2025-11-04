<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LearningProgram extends Model
{
    protected $table = "learning_program";
    
    protected $fillable = [
        'center_id', 'user_id', 'curso_id'
    ];

    // Relación con el curso
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    // Relación con el centro
    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    // Relación con el usuario (quién hace el curso)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el asistente
    public function assistant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assistent');
    }
}