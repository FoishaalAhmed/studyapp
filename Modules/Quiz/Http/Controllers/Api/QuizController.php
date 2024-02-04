<?php

namespace Modules\Quiz\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Quiz\Services\QuizService;
use Modules\Quiz\Http\Requests\Api\{QuizRequest, QuizLevelRequest};

class QuizController extends Controller
{
    public function __construct(private QuizService $service) 
    {
        
    }

    public function index()
    {
        $questionNumber = [
            '1' => '1 to 5',
            '2' => '1 to 10',
            '3' => '1 to 15',
            '4' => '1 to 20',
            '5' => '1 to 25'
        ];

        return $this->successResponse($questionNumber);
    }

    public function levels(QuizLevelRequest $request)
    {
        $questions = $this->service->getQuizLevel($request);
        return $this->successResponse($questions);
    }

    public function question(QuizRequest $request)
    {
        $questions = $this->service->getQuizQuestions($request);
        return $this->successResponse($questions);
    }

    public function levelComplete(QuizRequest $request)
    {
        try {
            $this->service->quizLevelComplete($request);
            return $this->successResponse();
        } catch (\Exception $exception) {
            return $this->unprocessableResponse([], $exception->getMessage());
        }

        
    }
}
