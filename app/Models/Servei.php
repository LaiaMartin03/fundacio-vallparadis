<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servei extends Model
{
    use HasFactory;

    protected $table = 'serveis';

    protected $fillable = [
        'tipus',
        'name',
        'description',
        'observacions',
        'internal_doc_id',
        'user_id',
    ];

    public function internalDoc()
    {
        return $this->belongsTo(InternalDoc::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
