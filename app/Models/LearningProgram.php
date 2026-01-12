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

    // Relación con el usuario (professional) — users table
    public function user(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'user_id');
    }

}