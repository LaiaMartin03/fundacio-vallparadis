<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationFormAnswer extends Model
{
    protected $table = 'evaluation_form_answers';

    protected $fillable = [
        'evaluation_form_id',
        'question_key',
        'score',
    ];

    public function form()
    {
        return $this->belongsTo(EvaluationForm::class, 'evaluation_form_id');
    }
}