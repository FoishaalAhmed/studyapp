<?php

namespace Modules\Category\Entities;

use Modules\Ebook\Entities\Ebook;
use Illuminate\Database\Eloquent\Model;
use Modules\UserAccess\Entities\UserAccess;
use Modules\LectureSheet\Entities\LectureSheet;
use Modules\Mcq\Entities\{ModelTest, Question};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildCategory extends Model
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

    public function questions()
    {

        return $this->hasManyThrough(Question::class, ModelTest::class);
    }

    public function models()
    {

        return $this->hasMany(ModelTest::class);
    }

    public function ebooks()
    {

        return $this->hasMany(Ebook::class);
    }

    public function sheets()
    {

        return $this->hasMany(LectureSheet::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class, 'type', 'id');
    }

    public function getCategoriesBySubcategory($sub_category_id)
    {
        $categories = $this->join('sub_categories', 'child_categories.sub_category_id', '=', 'sub_categories.id')
            ->join('category_types', 'child_categories.type', '=', 'category_types.id')
            ->where('child_categories.sub_category_id', $sub_category_id)
            ->where('child_categories.type', 'Model Test')
            ->orderBy('sub_categories.name', 'asc')
            ->orderBy('child_categories.name', 'asc')
            ->select('child_categories.*', 'sub_categories.name as category', 'category_types.name as type')
            ->get();
        return $categories;
    }

    public function getCategories($subCategory = null)
    {
        $query = $this->join('sub_categories', 'child_categories.sub_category_id', '=', 'sub_categories.id')
            ->join('category_types', 'child_categories.type', '=', 'category_types.id');
        if ($subCategory != null) $query->where('child_categories.sub_category_id', $subCategory);
        $query->orderBy('sub_categories.name', 'asc')
            ->orderBy('child_categories.name', 'asc')
            ->select('child_categories.*', 'sub_categories.name as category', 'category_types.name as type');
        $categories = $query->get();
        return $categories;
    }

    public function getWriterCategories($subCategory = null)
    {
        $category_ids = UserAccess::where('user_id', auth()->id())->pluck('child_category_id')->toArray();
        $query = $this->join('sub_categories', 'child_categories.sub_category_id', '=', 'sub_categories.id')
            ->join('category_types', 'child_categories.type', '=', 'category_types.id');
        if ($subCategory != null) $query->where('child_categories.sub_category_id', $subCategory);
        $query->whereIn('child_categories.id', $category_ids)
            ->orderBy('sub_categories.name', 'asc')
            ->orderBy('child_categories.name', 'asc')
            ->select('child_categories.*', 'sub_categories.name as category', 'category_types.name as type');
        $categories = $query->get();
        return $categories;
    }

    public function storeCategory(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadImage($image, 'public/images/childcategory/', 'childcategory', '465*260');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/childcategory/' . $response['file_name'];
        }

        $this->name = $request->name;
        $this->type = $request->type;
        $this->user_id = auth()->id();
        $this->sub_category_id = $request->sub_category_id;
        $storeCategory = $this->save();

        if (auth()->user()->hasRole('Writer')) {
            $userAccess = new UserAccess();
            $userAccess-> user_id = auth()->id();
            $userAccess->child_category_id = $this->id;
            $userAccess->save();
        }

        $storeCategory
            ? session()->flash('success', 'New Child Category Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');

        return $this->id;
    }

    public function updateCategory(Object $request, Object $category)
    {
        $image = $request->file('photo');

        if ($image) {
            $response = uploadImage($image, 'public/images/childcategory/', 'childcategory', '465*260', $category->photo);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }
            $category->photo = 'public/images/childcategory/' . $response['file_name'];
        }

        $category->name = $request->name;
        $category->type = $request->type;
        $category->sub_category_id = $request->sub_category_id;
        $updateCategory = $category->save();

        $updateCategory
            ? session()->flash('success', 'Child Category Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyCategory(Object $category)
    {
        if (file_exists($category->photo)) unlink($category->photo);
        $destroyCategory = $category->delete();

        $destroyCategory
            ? session()->flash('success', 'Child Category Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function getWriterChildCategoryCount($user_id, $start_date = '', $end_date = '')
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
