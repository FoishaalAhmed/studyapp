<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'exam_id'
    ];

    public static function storeExamUser($examId)
    {
        $examUser = new self;
        $examUser->exam_id = $examId;
        $examUser->user_id = auth()->id();
        $examUser->save();
    }
}
