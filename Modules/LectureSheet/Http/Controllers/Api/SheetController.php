<?php

namespace Modules\LectureSheet\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Enums\{CategoryType, Status};
use Modules\LectureSheet\Entities\LectureSheet;
use Modules\Category\Entities\{ChildCategory, SubCategory};

class SheetController extends Controller
{
    public function index()
    {
        $sheets = LectureSheet::where('status', Status::PUBLISHED)->latest()->get(['id', 'chapter', 'thumb', 'type']);
        return $this->successResponse($sheets);
    }

    public function category()
    {
        $categories = SubCategory::withCount('sheets')->where('type', CategoryType::CommonLectureSheet)->oldest('name')->get();
        return $this->successResponse($categories);
    }

    public function premiumSubCategory($categoryId)
    {
        $categories = ChildCategory::withCount('sheets')->where(['type' => CategoryType::LectureSheet, 'sub_category_id' => $categoryId])->oldest('name')->get();
        return $this->successResponse($categories);
    }

    public function subCategory($categoryId)
    {
        $categories = ChildCategory::withCount('sheets')->where('sub_category_id', $categoryId)->oldest('name')->get();
        return $this->successResponse($categories);
    }

    public function categorySheet($categoryId)
    {
        $sheets = LectureSheet::where(['child_category_id' => $categoryId, 'status' => Status::PUBLISHED])->latest()->get(['id', 'chapter', 'thumb', 'type']);
        return $this->successResponse($sheets);
    }

    public function subjectSheet($subjectId)
    {
        $sheets = LectureSheet::where(['subject_id' => $subjectId, 'status' => Status::PUBLISHED])->latest()->get(['id', 'chapter', 'thumb', 'type']);
        return $this->successResponse($sheets);
    }

    public function categorySubjectSheet($categoryId, $subjectId)
    {
        $sheets = LectureSheet::where(['child_category_id' => $categoryId, 'subject_id' => $subjectId, 'status' => Status::PUBLISHED])->latest()->get(['id', 'chapter', 'thumb', 'type']);
        return $this->successResponse($sheets);
    }

    public function detail($id)
    {
        $sheet = LectureSheet::where('id', $id)->first(['id', 'chapter', 'thumb', 'file', 'type']);

        if (is_null($sheet)) {
            return $this->unprocessableResponse([], __('Lecture sheet does not exist.'));
        }

        return $this->successResponse($sheet);
    }
}
