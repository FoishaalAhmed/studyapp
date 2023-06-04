<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'category_id');
    }

    public function marks()
    {

        return $this->hasManyThrough(ExamMark::class, Exam::class)->select('right_answer', 'wrong_answer')->where('exam_marks.user_id', auth()->id());
    }

    public function storeCategory(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadImage($image, 'public/images/category/', 'category', '465*260');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/category/' . $response['file_name'];
        }

        $this->name = $request->name;
        $storeCategory = $this->save();

        $storeCategory
            ? session()->flash('success', 'New Category Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateCategory(Object $request)
    {
        $category = $this::findOrFail($request->id);
        $image = $request->file('photo');

        if ($image) {

            $response = uploadImage($image, 'public/images/category/', 'category', '465*260', $category->photo);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $category->photo = 'public/images/category/' . $response['file_name'];
        }

        $category->name = $request->name;
        $updateCategory = $category->save();

        $updateCategory
            ? session()->flash('success', 'Category Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyCategory(Object $category)
    {
        if (file_exists($category->photo)) unlink($category->photo);
        $destroyCategory = $category->delete();

        $destroyCategory
            ? session()->flash('success', 'Category Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
