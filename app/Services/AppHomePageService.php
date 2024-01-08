<?php

namespace App\Services;

use App\Enums\CategoryType;
use App\Models\AppHomePage;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;

class AppHomePageService
{
    public function getAppHomePageData()
    {
        $result = [];

        AppHomePage::all()->map(function ($item) use (&$result) {

            $categoryIds = explode(',', $item->common_for);
            $subCategoryIds = explode(',', $item->common_categories);
            $categories = Category::whereIn('id', $categoryIds)->get(['id', 'name']);
            $subcategories = SubCategory::whereIn('id', $subCategoryIds)->get(['id', 'name']);

            $result[$item->id] = [
                'id' => $item->id,
                'type' => $item->type,
                'title' => $item->title,
                'categories' => $categories,
                'subcategories' => $subcategories,
            ];
        });

        return $result;
    }

    public function getHomePageCategories()
    {
        $data = [
            'categories' => Category::oldest('name')->get(['id', 'name']),
            'mcqCategories' => SubCategory::whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->oldest('name')->get(['id', 'name']),
            'ebookCategories' => SubCategory::whereIn('type', [CategoryType::Ebook, CategoryType::CommonEbook])->oldest('name')->get(['id', 'name']),
            'sheetCategories' => SubCategory::whereIn('type', [CategoryType::LectureSheet, CategoryType::CommonLectureSheet])->oldest('name')->get(['id', 'name']),
        ];

        return $data;
    }

    public function getAppHomePageEditData($appHome)
    {
        switch ($appHome->type) {

            case 'MCQ':
                $types = [CategoryType::ModelTest, CategoryType::CommonModelTest];
                break;

            case 'Ebook':
                $types = [CategoryType::Ebook, CategoryType::CommonEbook];
                break;

            default:
                $types = [CategoryType::LectureSheet, CategoryType::CommonLectureSheet];
                break;
        }

        $data = [
            'categories' => Category::oldest('name')->get(['id', 'name']),
            'subcategories' => SubCategory::whereIn('type', $types)->oldest('name')->get(['id', 'name']),
            'appHome' => $appHome,
        ];

        return $data;
    }
}
