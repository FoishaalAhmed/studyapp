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

    public function storeUserCategories(object $request)
    {
        foreach ($request->category_id as $value) {
            $data[] = [
                'user_id' => $request->user_id,
                'category_id' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        self::insert($data);
    }

    public function updateUserCategory($request)
    {
        $this->where('user_id', auth()->id())->delete();
        
        foreach ($request->category_id as $value) {
            $data[] = [
                'user_id' => auth()->id(),
                'category_id' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        self::insert($data);
    }
}
