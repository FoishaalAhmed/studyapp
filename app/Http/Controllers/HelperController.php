<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use Modules\Category\Entities\SubCategory;

class HelperController extends Controller
{
    public function getSubCategories()
    {
        $type = request()->type;
        $categories = SubCategory::where('type', $type)->get(['id', 'name']);
        echo json_encode($categories);
    }

    public function getChildCategorySubject()
    {
        $childCategoryId = request()->category_id;
        $subjects = getSubjectsByChildCategory($childCategoryId);
        echo json_encode($subjects);
    }

    public function getCategorySubject()
    {
        $categoryId = request()->category_id;
        $categories = getSubjectsByCategory($categoryId);
        echo json_encode($categories);
    }

    public function getChildCategoryByTypeAndSubCategory()
    {
        $subCategoryId = request()->subCategory;
        $type = request()->type;
        $categories = getChildCategoryByTypeAndSubCategory($subCategoryId, $type);
        echo json_encode($categories);
    }

    public function getSubCategoryByCategory()
    {
        $categoryId = request()->categoryId;

        $categories = [
            'mcqCategories' => SubCategory::where('category_id', $categoryId)->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->oldest('name')->get(['id', 'name']),
            'ebookCategories' => SubCategory::where('category_id', $categoryId)->whereIn('type', [CategoryType::Ebook, CategoryType::CommonEbook])->oldest('name')->get(['id', 'name']),
            'sheetCategories' => SubCategory::where('category_id', $categoryId)->whereIn('type', [CategoryType::LectureSheet, CategoryType::CommonLectureSheet])->oldest('name')->get(['id', 'name']),
        ];

        echo json_encode($categories);
    }
}
