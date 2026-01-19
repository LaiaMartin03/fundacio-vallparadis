<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRFollowup extends Model
{
    use HasFactory;

    protected $table = 'hr_followups';

    protected $fillable = [
        'hr_id',
        'date',
        'topic',
        'description',
        'attached_docs',
        'registrant_id'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Relación con el caso HR
     */
    public function hr()
    {
        return $this->belongsTo(HR::class, 'hr_id');
    }

    /**
     * Relación con el usuario que registró el seguimiento
     */
    public function registrant()
    {
        return $this->belongsTo(User::class, 'registrant_id');
    }
}