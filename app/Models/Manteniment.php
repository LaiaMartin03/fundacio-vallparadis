<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manteniment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'data',
        'responsable_id',
        'descripcio',
        'docs_adjunts',
    ];

    protected $casts = [
        'docs_adjunts' => 'array', // convierte JSON a array automáticamente
        'data' => 'date',
    ];

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
