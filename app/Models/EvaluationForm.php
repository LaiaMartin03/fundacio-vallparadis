<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    protected $table = 'evaluation_form';

    protected $fillable = [
        'professional_id',
        'evaluator_user_id',
        'total',
        'observations',
        'created_at',
        'updated_at',
    ];

    public function answers()
    {
        return $this->hasMany(EvaluationFormAnswer::class, 'evaluation_form_id');
    }

    public function professional()
    {
        return $this->belongsTo(\App\Models\User::class, 'professional_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(\App\Models\User::class, 'evaluator_user_id');
    }
}