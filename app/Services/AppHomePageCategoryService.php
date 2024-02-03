<?php

namespace App\Services;

use App\Enums\{CategoryType, AppType};
use App\Models\{AppHomePage, AppHomePageCategory};
use Modules\Category\Entities\{ChildCategory, SubCategory};

class AppHomePageCategoryService
{
    public function getAppHomePageCategories()
    {
        $result = [];

        AppHomePageCategory::with('subCategory:id,name')->get()->map(function ($item) use (&$result) {

            $categoryIds = explode(',', $item->categories);

            $subcategories = ChildCategory::whereIn('id', $categoryIds)->get(['id', 'name']);

            $result[$item->id] = [
                'id'         => $item->id,
                'title'      => $item->title,
                'type'       => $item->type,
                'categories' => $subcategories,
                'category'   => optional($item->subCategory)->name,
            ];
        });

        return $result;
    }

    public function getAppHomePageSubCategories()
    {
        $mcqCategory = $ebookCategory = $lectureSheetCategory = [];

        AppHomePage::get(['type', 'common_categories'])
            ->map(function ($item) use (&$mcqCategory, &$ebookCategory, &$lectureSheetCategory) {

            switch ($item->type) {
                case 'Sheet':
                    $sheet = explode(',', $item->common_categories);
                    
                    foreach ($sheet as $key => $sheetValue) {
                        $lectureSheetCategory[] = $sheetValue;
                    }
                    break;

                case 'MCQ':
                    $mcq = explode(',', $item->common_categories);
                    
                    foreach ($mcq as $key => $mcqValue) {
                        $mcqCategory[] = $mcqValue;
                    }
                    break;

                default:
                    $ebook = explode(',', $item->common_categories);
                    
                    foreach ($ebook as $key => $ebookValue) {
                        $ebookCategory[] = $ebookValue;
                    }
                    break;
            }
        });

        $data = [

            'mcqCategories' => SubCategory::whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->whereIn('id', $mcqCategory)->oldest('name')->get(['id', 'name']),

            'ebookCategories' => SubCategory::whereIn('type', [CategoryType::Ebook, CategoryType::CommonEbook])->whereIn('id', $ebookCategory)->oldest('name')->get(['id', 'name']),

            'sheetCategories' => SubCategory::whereIn('type', [CategoryType::LectureSheet, CategoryType::CommonLectureSheet])->whereIn('id', $lectureSheetCategory)->oldest('name')->get(['id', 'name']),
        ];

        return $data;
    }

    public function getAppHomePageEditData(Object $appHomeCategory)
    {
        switch ($appHomeCategory->type) {

            case 'MCQ':
                $types = [CategoryType::ModelTest, CategoryType::CommonModelTest];
                $appType = AppType::MCQ;
                break;

            case 'Ebook':
                $types = [CategoryType::Ebook, CategoryType::CommonEbook];
                $appType = AppType::Ebook;
                break;

            default:
                $types = [CategoryType::LectureSheet, CategoryType::CommonLectureSheet];
                $appType = AppType::LectureSheet;
                break;
        }

        $category = [];

        AppHomePage::where('type', $appType)->get(['common_categories'])
            ->map(function ($item) use (&$category) {

                $array = explode(',', $item->common_categories);

                foreach ($array as $key => $arrayValue) {
                    $category[] = $arrayValue;
                }

        });

        $data = [
            'appHomeCategory' => $appHomeCategory,
            'categories'      => SubCategory::whereIn('type', $types)->whereIn('id', $category)->oldest('name')->get(['id', 'name']),
            'subCategories'  => ChildCategory::whereIn('type', $types)->where('sub_category_id', $appHomeCategory->sub_category_id)->oldest('name')->get(['id', 'name']),
        ];

        return $data;
    }

    public function getAppHomePageData(String $type, Array $category)
    {
        switch ($type) {

            case 'MCQ':
                $types = [CategoryType::ModelTest, CategoryType::CommonModelTest];
                $appType = AppType::MCQ;
                break;

            case 'Ebook':
                $types = [CategoryType::Ebook, CategoryType::CommonEbook];
                $appType = AppType::Ebook;
                break;

            default:
                $types = [CategoryType::LectureSheet, CategoryType::CommonLectureSheet];
                $appType = AppType::LectureSheet;
                break;
        }

        $commonCategory = [];

        $response = [];

        AppHomePage::where('type', $appType)->get(['title', 'common_for', 'common_categories'])->map(function ($item) use (&$commonCategory, $category, &$response) {

            $array = explode(',', $item->common_for);

            if (count(array_intersect($category, $array))) {

                $response = [
                    'title' => $item->title
                ];
        
                $commonCategories = explode(',', $item->common_categories);

                foreach ($commonCategories as $key => $arrayValue) {
                    
                    $commonCategory[] = $arrayValue;
                }
            }
        });

        $response['subcategories'] = SubCategory::whereIn('type', $types)->whereIn('id', $commonCategory)->oldest('name')->get(['id', 'name', 'photo']);

        return $response;
    }
}
