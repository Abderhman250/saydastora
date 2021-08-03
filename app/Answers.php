<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

class Answers extends Model
{
    protected $table = "answers";

    protected $fillable = [
        'question_id', 'answer_1', 'answer_2','answer_3','points',
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class,'question_id');
    }
}
