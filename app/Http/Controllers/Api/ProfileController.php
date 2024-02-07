<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Modules\Category\Entities\{Category, CategoryUser};
use Modules\Mcq\Entities\{ModelMark, ModelQuestionAnswer, Question};
use Modules\Exam\Entities\{ExamMark, ExamQuestion, ExamQuestionAnswer, ExamUser};
use App\Http\Requests\Api\{ProfilePasswordRequest, ProfilePhotoRequest, ProfileRequest};

class ProfileController extends Controller
{
    private $profileObject;

    public function __construct()
    {
        $this->profileObject = new Profile();
    }

    public function index()
    {
        return $this->successResponse(auth()->user());
    }

    public function photo(ProfilePhotoRequest $request)
    {   
        try {
            $this->profileObject->updateUserPhoto($request);
            return $this->successResponse(__('Profile Picture Updated Successfully!'));
        } catch (Exception $exception) {
            return $this->unprocessableResponse([], $exception->getMessage());
        }
    }

    public function password(ProfilePasswordRequest $request)
    {
        try {
            $this->profileObject->updateUserPassword($request);
            return $this->successResponse(__('Password Updated Successfully!'));
        } catch (Exception $exception) {
            return $this->unprocessableResponse([], $exception->getMessage());
        }
    }

    public function info(ProfileRequest $request)
    {
        try {
            $this->profileObject->updateUserInfo($request);
            return $this->successResponse(__('Profile Updated Successfully!'));
        } catch (Exception $exception) {
            return $this->unprocessableResponse([], $exception->getMessage());
        }
    }

    public function allInfo()
    {
        $examIds = ExamUser::where('user_id', auth()->id())->distinct()->pluck('exam_id')->toArray();
        $categoryIds = CategoryUser::where('user_id', auth()->id())->distinct()->pluck('category_id')->toArray();
        $modeTestIds = ModelQuestionAnswer::where('user_id', auth()->id())->distinct()->pluck('model_test_id')->toArray();

        $userRanks = ModelMark::with('user')->groupBy('user_id')->orderByRaw('SUM(right_answer) DESC')->orderBy('total_time', 'asc')->get();
        $rank = $userRanks->search(function ($userRank) {
            return $userRank->user_id === auth()->id();
        });

        $totalQuestion = Question::count();
        $totalAnswer = ModelQuestionAnswer::where('user_id', auth()->id())->count();
        $totalModelComplete = ($totalAnswer * 100) / $totalQuestion;

        $totalExamQuestion = ExamQuestion::count();
        $totalExamAnswer = ExamQuestionAnswer::where('user_id', auth()->id())->count();
        $totalExamComplete = ($totalExamAnswer * 100) / $totalExamQuestion;

        $response = [
            'userRank'             => $rank + 1,
            'examPercentage'       => number_format((float)$totalExamComplete, 2, '.', ''),
            'modelPercentage'      => number_format((float)$totalModelComplete, 2, '.', ''),
            'examTotalQuestion'    => ExamQuestion::whereIn('exam_id', $examIds)->count(),
            'examAttemptQuestion'  => ExamQuestionAnswer::whereIn('exam_id', $examIds)->count(),
            'examRightAnswer'      => ExamMark::whereIn('exam_id', $examIds)->sum('right_answer'),
            'examWrongAnswer'      => ExamMark::whereIn('exam_id', $examIds)->sum('wrong_answer'),
            'modelTotalQuestion'   => Question::whereIn('model_test_id', $modeTestIds)->count(),
            'modelAttemptQuestion' => ModelQuestionAnswer::whereIn('model_test_id', $modeTestIds)->count(),
            'modelRightAnswer'     => ModelMark::whereIn('model_test_id', $modeTestIds)->sum('right_answer'),
            'modelWrongAnswer'     => ModelMark::whereIn('model_test_id', $modeTestIds)->sum('wrong_answer'),
            'examCategories'       => Category::with('marks')->whereIn('id', $categoryIds)->get(),
            'allUserRanks'         => ModelMark::with('user')->groupBy('user_id')->orderByRaw('SUM(right_answer) DESC')
                                        ->oldest('total_time')->take(100)->get(),
        ];

        return $this->successResponse($response);
    }
}
