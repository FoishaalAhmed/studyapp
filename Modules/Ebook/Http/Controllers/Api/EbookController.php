<?php

namespace Modules\Ebook\Http\Controllers\Api;

use App\Enums\CategoryType;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use Modules\Category\Entities\ChildCategory;
use Modules\Category\Entities\SubCategory;
use Modules\Ebook\Entities\Ebook;

class EbookController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::latest()->get(['id', 'title', 'thumb', 'type']);

        return $this->successResponse($ebooks);
    }

    public function ebook($id)
    {
        $ebook = Ebook::where('id', $id)->first(['id', 'title', 'thumb', 'book', 'type']);

        if (empty($ebook)) {
            $this->unprocessableResponse([], __('Ebook does not exit'));
        }

        return $this->successResponse($ebook);
    }

    /** All ebook subcategories **/

    public function category()
    {
        $categories = SubCategory::withCount(['ebooks'])->whereIn('type', [CategoryType::Ebook, CategoryType::CommonEbook])->oldest('name')->get();

        return $this->successResponse($categories);
    }

    /** All ebook premium child categories **/
    public function premiumChildCategory($category_id)
    {
        $categories = ChildCategory::withCount(['ebooks'])->where(['type' => CategoryType::Ebook, 'sub_category_id' => $category_id])->oldest('name')->get();

        return $this->successResponse($categories);
    }

    /** All ebook common child categories **/
    public function commonChildCategory($category_id)
    {
        $categories = ChildCategory::withCount(['ebooks'])->where(['sub_category_id' => $category_id, 'type' => CategoryType::CommonEbook])->oldest('name')->get();
        return $this->successResponse($categories);
    }

    /** All category ebook **/
    public function categoryEbook($category_id)
    {
        $ebooks = Ebook::where(['child_category_id' => $category_id, 'status' => Status::PUBLISHED])->latest()->get(['id', 'title', 'thumb', 'type']);
        return $this->successResponse($ebooks);
    }

    /** All subject ebook **/
    public function subjectEbook($subject_id)
    {
        $ebooks = Ebook::where(['subject_id' => $subject_id, 'status' => Status::PUBLISHED])->latest()->get(['id', 'title', 'thumb', 'type']);
        return $this->successResponse($ebooks);
    }

    /** All subject category ebook **/
    public function categorySubjectEbook($category_id, $subject_id)
    {
        $ebooks = Ebook::where(['subject_id' => $subject_id, 'child_category_id' => $category_id, 'status' => Status::PUBLISHED])->latest()->get(['id', 'title', 'thumb', 'type']);
        return $this->successResponse($ebooks);
    }
}
