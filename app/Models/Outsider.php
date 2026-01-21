<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outsider extends Model
{
    // Si el nombre de la tabla no sigue la convención, descomenta la línea siguiente:
    // protected $table = 'outsiders';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'service',
        'task',
        'business',
        'description',
    ];
}
