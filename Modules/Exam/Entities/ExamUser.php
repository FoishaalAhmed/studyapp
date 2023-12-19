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

    public function storeExamUser(Object $request)
    {
        $this->exam_id = $request->exam_id;
        $this->user_id = auth()->id();
        $this->save();
    }
}
