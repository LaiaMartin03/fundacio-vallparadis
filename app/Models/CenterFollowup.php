<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CenterFollowup extends Model
{
    protected $table = 'center_followups';

    protected $fillable = [
        'date',
        'description',
        'center_id',
        'professional_user_id',
        'registrant_user_id',
        'type',
        'topic',
        'attached_docs',
    ];

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'professional_user_id');
    }

    public function registrant(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'registrant_user_id');
    }

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    public function isRestricted(): bool
    {
        return $this->type === 'restringit';
    }
}