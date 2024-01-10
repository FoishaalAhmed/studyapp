<?php

namespace App\Services;

use App\Enums\CategoryType;
use App\Models\AppUserCategory;
use Modules\Category\Entities\{Category, SubCategory};

class AppUserCategoryService
{
    public function getAppUserCategories()
    {
        $result = [];

        AppUserCategory::with('category:id,name')->get()->map(function ($item) use (&$result) {

            $categoryIds = explode(',', $item->categories);

            $subcategories = SubCategory::whereIn('id', $categoryIds)->get(['id', 'name']);

            $result[$item->id] = [
                'id'         => $item->id,
                'title'      => $item->title,
                'category'      => optional($item->category)->name,
                'type'       => $item->type,
                'categories' => $subcategories,
            ];
        });

        return $result;
    }

    public function getAppUserCategoryEditData($appUserCategory)
    {
        switch ($appUserCategory->type) {

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
            'subCategories' => SubCategory::whereIn('type', $types)->where('category_id', $appUserCategory->category_id)->oldest('name')->get(['id', 'name']),
            'appUserCategory' => $appUserCategory,
        ];

        return $data;
    }

    public function getAppUserSubCategories(Int $categoryId)
    {
        $categoriesIds = [];
        $categories = [];

        $uniqueTypes = array_values(array_column(AppUserCategory::where('category_id', $categoryId)->get()->toArray(), null, 'type'));

        foreach ($uniqueTypes as $typeValue) {

            foreach (AppUserCategory::where('type', $typeValue['type'])->pluck('categories') as $categoryIds) {

                $categoryIdArray = explode(',', $categoryIds);

                foreach ($categoryIdArray as $categoryId) {
                    $categoriesIds[] = $categoryId;
                }
            }

            $categories[] = [
                'title' => $typeValue['title'],
                'categories' => SubCategory::whereIn('id', $categoriesIds)->get(['id', 'name', 'photo'])
            ];

            $categoriesIds = [];
        }

        return $categories;
    }
}