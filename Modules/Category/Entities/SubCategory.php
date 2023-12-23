<?php

namespace Modules\Category\Entities;

use Modules\Ebook\Entities\Ebook;
use Modules\Mcq\Entities\ModelTest;
use Illuminate\Database\Eloquent\Model;
use Modules\LectureSheet\Entities\LectureSheet;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class SubCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'type', 'category_id', 'photo'
    ];

    public function models()
    {

        return $this->hasManyThrough(ModelTest::class, ChildCategory::class);
    }

    public function ebooks()
    {

        return $this->hasManyThrough(Ebook::class, ChildCategory::class);
    }

    public function sheets()
    {

        return $this->hasManyThrough(LectureSheet::class, ChildCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categoryType()
    {
       return $this->belongsTo(CategoryType::class,'type', 'id');
    }

    // public function getCategories()
    // {
    //     $categories = $this->join('categories', 'sub_categories.category_id', '=', 'categories.id')
    //         ->join('category_types', 'sub_categories.type', '=', 'category_types.id')
    //         ->orderBy('categories.name', 'asc')
    //         ->orderBy('sub_categories.name', 'asc')
    //         ->select('sub_categories.*', 'categories.name as category', 'category_types.name as type')
    //         ->get();
    //     return $categories;
    // }

    public function storeCategory(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadImage($image, 'public/images/subcategory/', 'subcategory', '465*260');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/subcategory/' . $response['file_name'];
        }

        $this->name = $request->name;
        $this->type = $request->type;
        $this->category_id = $request->category_id;
        $this->user_id = auth()->id();
        $storeCategory = $this->save();

        $storeCategory
            ? session()->flash('success', 'New SubCategory Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateCategory(Object $request, Object $category)
    {

        $image = $request->file('photo');

        if ($image) {

            $response = uploadImage($image, 'public/images/subcategory/', 'subcategory', '465*260', $category->photo);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $category->photo = 'public/images/subcategory/' . $response['file_name'];
        }

        $category->name = $request->name;
        $category->type = $request->type;
        $category->category_id = $request->category_id;
        $updateCategory = $category->save();

        $updateCategory
            ? session()->flash('success', 'SubCategory Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyCategory(Object $category)
    {
        if (file_exists($category->photo)) unlink($category->photo);
        $destroyCategory = $category->delete();

        $destroyCategory
            ? session()->flash('success', 'SubCategory Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function getWriterSubCategoryCount($user_id, $start_date = '', $end_date = '')
    {
        $query = $this::where('user_id', $user_id);
        if ($start_date != '' && $end_date != '') {
            $query->whereDate('created_at', '>=', $start_date);
            $query->whereDate('created_at', '<=', $end_date);
        }

        $question = $query->count();

        return $question;
    }
}
