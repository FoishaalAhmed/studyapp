<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamMark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'exam_id', 'right_answer', 'wrong_answer', 'total_time',
    ];
}
