<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manteniment extends Model
{
    /**
     * Tabla asociada (por si no sigue convención).
     */
    protected $table = 'manteniment';

    /**
     * Campos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'tipo',
        'data',
        'descripcio',
        'responsable',
        'docs_adjunts',
    ];

    /**
     * Casteos automáticos.
     */
    protected $casts = [
        'data' => 'date',
        'docs_adjunts' => 'array',
    ];

    /**
     * Scope para filtrar por tipo.
     */
    public function scopeManteniment($query)
    {
        return $query->where('tipo', 'manteniment');
    }

    public function scopeSeguiment($query)
    {
        return $query->where('tipo', 'seguiment');
    }
}
