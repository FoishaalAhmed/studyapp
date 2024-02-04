<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\UserAccess\Entities\UserLog;
use App\Http\Requests\Api\UserLogRequest;
use Modules\Category\Entities\{Category, CategoryUser};
use Modules\Subject\Entities\{Subject, CategorySubject};

class HelperController extends Controller
{
    public function activeModules()
    {
        return $this->successResponse(getActiveModules());
    }

    public function UserCategoryAndSubject()
    {
        $categoryIds = CategoryUser::where('user_id', auth()->id())->pluck('category_id')->toArray();
        $subjectIds = CategorySubject::whereIn('category_id', $categoryIds)->pluck('subject_id')->toArray();

        $response = [
            'subjects' => Category::whereIn('id', $categoryIds)->get(['id', 'name', 'photo']),
            'categories' => Subject::whereIn('id', $subjectIds)->get(['id', 'name', 'photo']),
        ];

        return $this->successResponse($response);
    }

    public function userLog(UserLogRequest $request)
    {
        $userLogModelObject = new UserLog();
        $userLogModelObject->storeUserLog($request);

        return $this->successResponse();
    }
}
