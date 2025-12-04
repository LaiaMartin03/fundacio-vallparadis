<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HR extends Model
{
    protected $table = "pending_hr_issues";
    
    protected $fillable = [
        'affected_professional', 
        'description', 
        'attached_docs', 
        'center_id', 
        'assigned_to',
        'derivated_to'
    ];

    public function affectedProfessional(): BelongsTo
    {
        return $this->belongsTo(User::class, 'affected_professional');
    }
    
    public function derivatedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'derivated_to');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'center_id');
    }
}