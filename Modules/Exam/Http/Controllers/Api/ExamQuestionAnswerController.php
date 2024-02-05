<?php

namespace Modules\Exam\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Exam\Http\Requests\Api\ExamQuestionAnswerRequest;
use Modules\Exam\Entities\{Exam, ExamQuestion, ExamQuestionAnswer};

class ExamQuestionAnswerController extends Controller
{
    public function index()
    {
        $examIds = ExamQuestionAnswer::where('user_id', auth()->id())->pluck('exam_id')->toArray();
        $exams = Exam::whereIn('id', $examIds)->get(['id', 'title']);

        return $this->successResponse($exams);
    }

    public function store(ExamQuestionAnswerRequest $request)
    {
        $message = (new ExamQuestionAnswer)->storeExamQuestionAnswer($request);
        
        return $this->successResponse($message);
    }

    public function answers($examId)
    {
        $questionAnswers = ExamQuestion::with(['answer'])->where('exam_id', $examId)->get();
        return $this->successResponse($questionAnswers);
    }
}
