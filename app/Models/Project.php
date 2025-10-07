<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['center_id' , 'responsible_professional','name', 'description', 'observations', 'type', 'docs', 'start_date', 'finish_date' ];
}