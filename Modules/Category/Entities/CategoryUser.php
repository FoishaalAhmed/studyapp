<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id',
    ];
}
