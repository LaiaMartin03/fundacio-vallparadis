<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';

    protected $fillable = [
        'name',
        'forcem',
        'hours',
        'type',
        'modality',
        'info',
        'assistent',
        'start_date',
        'finish_date',
        'certification',
        'active'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'learning_programs', 'curso_id', 'user_id');
    }
}
