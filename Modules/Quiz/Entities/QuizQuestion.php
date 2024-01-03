<?php

namespace Modules\Quiz\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 'question', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer', 'level', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
