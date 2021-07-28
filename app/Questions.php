<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = "questions";

    protected $fillable = [
        'question', 'correct_answer_id', 'status','game_id','points',
    ];

    public function answers()
    {
        return $this->hasMany(Answers::class,'question_id');
    }

    public function getCorrectAnswerAttribute()
    {
        return Answers::where('id',$this->correct_answer_id)->first()->answer;
    }
}
