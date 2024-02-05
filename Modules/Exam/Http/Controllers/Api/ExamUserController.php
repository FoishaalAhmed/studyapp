<?php

namespace Modules\Exam\Http\Controllers\Api;

use Modules\Exam\Entities\ExamUser;
use App\Http\Controllers\Controller;
use Modules\Exam\Http\Requests\Api\ExamUserRequest;

class ExamUserController extends Controller
{
    public function store(ExamUserRequest $request)
    {
        ExamUser::storeExamUser($request);
        return $this->successResponse(__('You are enrolled for this exam'));
    }
}
