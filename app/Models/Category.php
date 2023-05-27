<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
    
    public function exams()
    {
        return $this->hasMany(Exam::class, 'category_id');
    }
    
    public function marks() {
        
        return $this->hasManyThrough(ExamMark::class, Exam::class)->select('right_answer', 'wrong_answer')->where('exam_marks.user_id', auth()->id());
    }

    public function storeCategory(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/category/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->name = $request->name;
        $storeCategory = $this->save() ;

        $storeCategory
            ? session()->flash('success', 'New Category Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateCategory(Object $request)
    {
        $category = $this::findOrFail($request->id);
        $image = $request->file('photo');

        if ($image) {

            if (file_exists($category->photo)) unlink($category->photo);

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/category/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $category->photo     = $image_url;
        }
        $category->name = $request->name;
        $updateCategory = $category->save() ;

        $updateCategory
            ? session()->flash('success', 'Category Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyCategory(Object $category)
    {
        if (file_exists($category->photo)) unlink($category->photo);
        $destroyCategory = $category->delete() ;

        $destroyCategory
            ? session()->flash('success', 'Category Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
