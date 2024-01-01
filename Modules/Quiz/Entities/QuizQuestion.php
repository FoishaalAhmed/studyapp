<?php

namespace Modules\Quiz\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 'question', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer', 'level', 'user_id'
    ];
}
