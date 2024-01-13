<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Modules\Exam\Entities\ExamQuestion;
use Modules\Exam\Entities\ExamQuestionAnswer;
use Modules\Mcq\Entities\ModelMark;
use Modules\Mcq\Entities\ModelQuestionAnswer;
use Modules\Mcq\Entities\Question;

class ProfileController extends Controller
{
    private $profileObject;

    public function __construct()
    {
        $this->profileObject = new Profile();
    }

    public function userProfile()
    {
        
        $totalQuestion = Question::count();
        $totalExamQuestion = ExamQuestion::count();
        $totalExamAnswer = ExamQuestionAnswer::where('user_id', auth()->id())->count();
        $totalAnswer = ModelQuestionAnswer::where('user_id', auth()->id())->count();
        $userRanks = ModelMark::with('user')->groupBy('user_id')->orderByRaw('SUM(right_answer) DESC')
        ->orderBy('total_time', 'asc')->get();

        $data = [
            'totalExamComplete' => ($totalAnswer * 100) / $totalQuestion,
            'totalModelComplete' => ($totalExamAnswer * 100) / $totalExamQuestion,
            'rank' => $userRanks->search(function ($userRank) {
                return $userRank->user_id === auth()->id();
            }),
        ];

        return view('backend.user.profile', $data);
    }

    public function photo(Request $request)
    {
        $request->validate(Profile::$validatePhotoRule);
        $this->profileObject->updateUserPhoto($request);
        return back();
    }

    public function password(Request $request)
    {
        $request->validate(Profile::$validatePasswordRule);
        $this->profileObject->updateUserPassword($request);
        return back();
    }

    public function info(ProfileRequest $request)
    {
        $this->profileObject->updateUserInfo($request);
        return back();
    }
}
