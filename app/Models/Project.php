<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['center_id' , 'responsible_professional','name', 'description', 'observations', 'type', 'docs','active','start_date', 'finish_date' ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function Professional()
    {
        return $this->belongsTo(Professional::class, 'responsible_professional');
    }
}