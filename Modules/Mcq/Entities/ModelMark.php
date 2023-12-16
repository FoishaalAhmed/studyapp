<?php

namespace Modules\Mcq\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelMark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'model_test_id', 'right_answer', 'wrong_answer', 'total_time',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
