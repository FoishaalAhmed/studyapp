<?php

namespace Modules\Mcq\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Mcq\Entities\{ModelQuestionAnswer, ModelTest, Question};

class QuestionAnswerController extends Controller
{
    public function index()
    {
        $model_ids = ModelQuestionAnswer::where('user_id', auth()->id())->pluck('model_test_id')->toArray();

        $models = ModelTest::whereIn('id', $model_ids)->select('id', 'title')->get();

        return response($models, 200);
    }

    public function store(Request $request)
    {
        $message = (new ModelQuestionAnswer)->storeModelQuestionAnswer($request);
        $response = ['message' => $message];
        return response($response, 200);
    }

    public function answers($model_test_id)
    {
        $questions = Question::with(['given_answer'])->where('model_test_id', $model_test_id)->get();
        return response($questions, 200);
    }
}
