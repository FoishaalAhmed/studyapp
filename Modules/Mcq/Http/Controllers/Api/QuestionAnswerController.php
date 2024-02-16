<?php

namespace Modules\Mcq\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Mcq\Http\Requests\Api\QuestionAnswerRequest;
use Modules\Mcq\Entities\{ModelQuestionAnswer, ModelTest, Question};

class QuestionAnswerController extends Controller
{
    public function index()
    {
        $modelIs = ModelQuestionAnswer::where('user_id', auth()->id())->pluck('model_test_id')->toArray();
        $models = ModelTest::whereIn('id', $modelIs)->get(['id', 'title']);

        return $this->successResponse($models);
    }

    public function store(QuestionAnswerRequest $request)
    {
        try {
            (new ModelQuestionAnswer)->storeModelQuestionAnswer($request);
            return $this->successResponse(__('MCQ Answer Submitted Successfully!'));
        } catch (\Exception $exception) {
            return $this->unprocessableResponse([], __('Request can not be processed at this moment. Please try again.'));
        }
        
    }

    public function answers($mcqId)
    {
        $questions = Question::with(['given_answer'])->where('model_test_id', $mcqId)->get();
        return $this->successResponse($questions);
    }
}
