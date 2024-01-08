<?php

namespace App\Services;

use App\Enums\{
    CategoryType,
    AppType
};

use App\Models\{
    AppUserChildCategory,
    ChildCategory,
    SubCategory,
    AppHomePage,
    AppUserCategory
};

class AppUserChildCategoryService
{
    public function getAppUserChildCategories()
    {
        $result = [];

        AppUserChildCategory::with('subCategory:id,name')->get()->map(function ($item) use (&$result) {

            $categoryIds = explode(',', $item->categories);

            $childCategories = ChildCategory::whereIn('id', $categoryIds)->get(['id', 'name']);

            $result[$item->id] = [

                'id'         => $item->id,

                'title'      => $item->title,

                'category'   => optional($item->subCategory)->name,

                'type'       => $item->type,

                'categories' => $childCategories,

            ];
        });

        return $result;
    }

    public function getAppUserCategories()
    {
        $mcqCategory = $ebookCategory = $lectureSheetCategory = [];

        AppUserCategory::get(['type', 'categories'])->map(function ($item) use (&$mcqCategory, &$ebookCategory, &$lectureSheetCategory) {

            switch ($item->type) {
                case 'Sheet':
                    $sheet = explode(',', $item->categories);
                    foreach ($sheet as $key => $sheetValue) {
                        $lectureSheetCategory[] = $sheetValue;
                    }
                    break;

                case 'MCQ':
                    $mcq = explode(',', $item->categories);
                    foreach ($mcq as $key => $mcqValue) {
                        $mcqCategory[] = $mcqValue;
                    }
                    break;

                default:
                    $ebook = explode(',', $item->categories);
                    foreach ($ebook as $key => $ebookValue) {
                        $ebookCategory[] = $ebookValue;
                    }
                    break;
            }
        });

        $data = [

            'mcqCategories' => SubCategory::whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->whereIn('id', $mcqCategory)->orderBy('name', 'asc')->get(['id', 'name']),

            'ebookCategories' => SubCategory::whereIn('type', [CategoryType::Ebook, CategoryType::CommonEbook])->whereIn('id', $ebookCategory)->orderBy('name', 'asc')->get(['id', 'name']),

            'sheetCategories' => SubCategory::whereIn('type', [CategoryType::LectureSheet, CategoryType::CommonLectureSheet])->whereIn('id', $lectureSheetCategory)->orderBy('name', 'asc')->get(['id', 'name']),
        ];

        return $data;
    }

    public function getAppUserChildCategoryEditData(Object $appUserChildCategory)
    {
        switch ($appUserChildCategory->type) {

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

        AppUserCategory::where('type', $appUserChildCategory->type)->get()->map(function ($item) use (&$category) {

            $categories = explode(',', $item->categories);

            foreach ($categories as $key => $value) {
                $category[] = $value;
            }
        });


        $data = [

            'categories' => SubCategory::whereIn('type', $types)->whereIn('id', $category)->orderBy('name', 'asc')->get(['id', 'name']),

            'subCategories' => ChildCategory::whereIn('type', $types)->where('sub_category_id', $appUserChildCategory->sub_category_id)->orderBy('name', 'asc')->get(['id', 'name']),

            'appUserChildCategory' => $appUserChildCategory,
        ];

        return $data;
    }

    public function getAppUserChildCategoryData()
    {
        $result = [];

        AppUserChildCategory::where('type', request()->type)->where('sub_category_id', request()->sub_category_id)->get(['type', 'title', 'categories'])->map(function ($item) use (&$result) {

            $categoryIds = explode(',', $item->categories);

            $childCategories = ChildCategory::whereIn('id', $categoryIds)->get(['id', 'name', 'photo']);

            $result[] = [

                'title'      => $item->title,

                'type'       => $item->type,

                'childCategories' => $childCategories,
            ];
        });

        return $result;
    }
}
