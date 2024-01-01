<?php

namespace Modules\Quiz\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 'user_id', 'level'
    ];
}
