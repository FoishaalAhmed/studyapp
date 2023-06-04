<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max:255']
    ];

    public function storeCategory(Object $request)
    {
        $this->name = $request->name;
        $storeCategory = $this->save();

        $storeCategory
            ? session()->flash('success', 'New Category Type Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateCategory(Object $request)
    {
        $category = $this::findOrFail($request->id);
        $category->name = $request->name;
        $updateCategory = $category->save();

        $updateCategory
            ? session()->flash('success', 'Category Type Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyCategory(Object $category)
    {
        $destroyCategory = $category->delete();

        $destroyCategory
            ? session()->flash('success', 'Category Type Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
