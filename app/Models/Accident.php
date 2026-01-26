<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Accident extends Model
{
    protected $fillable = [
        'date',
        'type',
        'context',
        'description',
        'durada',
        'professional_id',
        'registrant_user_id',
        'fitxa_file_path',
        'fitxa_original_filename',
    ];

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    public function registrant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrant_user_id');
    }
}
