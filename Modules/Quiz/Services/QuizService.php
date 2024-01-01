<?php

namespace Modules\Quiz\Services;

class QuizService
{
    public function quizQuestionData(object $questions, int $quizId):array
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
}