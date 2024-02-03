<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChildCategoryRequest;
use App\Http\Requests\Api\SubCategoryRequest;
use App\Http\Requests\Api\UpdateUserCategoryRequest;
use Modules\Job\Entities\JobCategory;
use App\Services\AppHomePageCategoryService;
use App\Services\AppUserCategoryService;
use App\Services\AppUserChildCategoryService;
use Modules\Category\Entities\{Category, CategoryUser};
use Modules\Subject\Entities\{Subject, CategorySubject};

class UserCategoryController extends Controller
{
    public function index(AppHomePageCategoryService $service)
    {
        $categoryIds      = CategoryUser::where('user_id', auth()->id())->pluck('category_id')->toArray();
        $subjectIds       = CategorySubject::whereIn('category_id', $categoryIds)->pluck('subject_id')->toArray();

        $data = [
            'jobCategories' => JobCategory::withCount('jobs')->orderBy('name', 'asc')->get(),
            'userSubjects' => Subject::whereIn('id', $subjectIds)->get(['id', 'name', 'photo']),
            'userCategories' => Category::whereIn('id', $categoryIds)->get(['id', 'name', 'photo']),
            'mcqCategories' => $service->getAppHomePageData('MCQ', $categoryIds),
            'ebookCategories' => $service->getAppHomePageData('Ebook', $categoryIds),
            'sheetCategories' => $service->getAppHomePageData('Sheet', $categoryIds),
        ];

        return $this->successResponse($data);
    }

    public function subCategory(SubCategoryRequest $request, AppUserCategoryService $service)
    {
        $categoryId = $request->category_id;
        $response = $service->getAppUserSubCategories($categoryId);

        return $this->successResponse($response);
    }

    public function childCategory(ChildCategoryRequest $request, AppUserChildCategoryService $service)
    {
        $subCategoryId = $request->sub_category_id;
        return $this->successResponse($service->getAppUserChildCategoryData($subCategoryId));
    }

    public function update(UpdateUserCategoryRequest $request)
    {
        try {
            (new CategoryUser)->updateUserCategory($request);
            return $this->successResponse(__('User category updated successfully.'));
        } catch (\Exception $exception) {
           return $this->unprocessableResponse([], __('Request could not be processed now. Please try later.'));
        }
    }
}
