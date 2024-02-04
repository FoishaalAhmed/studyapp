<?php

namespace Modules\Quiz\Services;

use App\Enums\Status;
use Modules\Quiz\Entities\Quiz;
use Illuminate\Support\Collection;
use Modules\Quiz\Entities\QuizQuestion;
use Modules\Quiz\Entities\QuizUser;
use Modules\Quiz\Transformers\QuizResource;

class QuizService
{
    public function quizQuestionData(object $questions, int $quizId): array
    {
        foreach ($questions as $key => $value) {
            $quizQuestionData[] = [
                'quiz_id'        => $quizId,
                'question'       => $value->question,
                'answer1'        => $value->answer1,
                'answer2'        => $value->answer2,
                'answer3'        => $value->answer3,
                'answer4'        => $value->answer4,
                'user_id'        => auth()->id(),
                'created_at'     => now(),
                'updated_at'     => now(),
                'level'          => self::getQuizLevels($key),
                'correct_answer' => $value->answer
            ];
        }

        return $quizQuestionData;
    }

    private function getQuizLevels(int $key): int
    {
        switch ($key) {
            case $key >= 0 && $key <= 4:
                $level = 1;
                break;
            case $key >= 5 && $key <= 14:
                $level = 2;
                break;
            case $key >= 15 && $key <= 29:
                $level = 3;
                break;
            case $key >= 30 && $key <= 49:
                $level = 4;
                break;
            case $key >= 50 && $key <= 74:
                $level = 5;
                break;
            case $key >= 75 && $key <= 99:
                $level = 6;
                break;
            default:
                $level = 7;
                break;
        }

        return $level;
    }

    public function getQuizLevel(object $request): array
    {
        $categoryId = $request->category;
        $level = $request->level;

        $quizzes = Quiz::withCount([
            'questions' => fn ($query) =>
            [
                $query->where('level', $level)
            ]
        ])->where(['category_id' => $categoryId, 'status' => Status::PUBLISHED])
            ->whereHas('questions', fn ($query) => [
                $query->where('level', $level)
            ])->oldest()->get(['id', 'title', 'photo', 'price']);

        $quizzes->map(function ($quiz, $key) {
            $quiz->title = 'Level ' . $key + 1;
            return $quiz;
        });

        $userCompletedLevels = QuizUser::where(['level' => $level, 'user_id' => auth()->id()])->pluck('quiz_id')->toArray();

        return [
            'levels' => QuizResource::collection($quizzes),
            'userCompletedLevels' => $userCompletedLevels
        ];
    }

    public function getQuizQuestions($request): Collection
    {
        $quizId = $request->quiz;
        $level  = $request->level;
        return QuizQuestion::where(['quiz_id' => $quizId, 'level' => $level])->get(['question', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer', 'level']);
    }

    public function quizLevelComplete($request)
    {
        $quizId = $request->quiz;
        $level  = $request->level;
        $quizUser = QuizUser::where(['user_id' => auth()->id(), 'quiz_id' => $quizId, 'level' => $level])->first();

        if (is_null($quizUser)) {
            QuizUser::insert([
                'user_id' => auth()->id(),
                'quiz_id' => $quizId,
                'level'   => $level,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
