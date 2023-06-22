<?php

namespace Modules\Subject\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategorySubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'subject_id',
    ];
}
