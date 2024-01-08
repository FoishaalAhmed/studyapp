<?php

namespace App\Http\Controllers;

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
}
