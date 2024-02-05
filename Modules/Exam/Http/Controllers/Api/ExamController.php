<?php

namespace Modules\Exam\Http\Controllers\Api;

use App\Enums\{Status, ExamType};
use App\Http\Controllers\Controller;
use Modules\Category\Entities\CategoryUser;
use Modules\Subject\Entities\{Subject, CategorySubject};
use Modules\Exam\Entities\{Exam, ExamMark, ExamQuestion};

class ExamController extends Controller
{
    public function live()
    {
        $categoryIds = CategoryUser::where('user_id', auth()->id())->pluck('category_id')->toArray();
        $subjectIds = CategorySubject::whereIn('category_id', $categoryIds)->pluck('subject_id')->toArray();

        $exams = Exam::withCount([
            'questions',
            'question_answer',
            'exam_user',
            'exam_users'
        ])->where([
            'exam_type' => ExamType::LIVE,
            'status' => Status::PUBLISHED,
            'start_date' => date('Y-m-d')
        ])->whereIn('category_id', $categoryIds)
            ->take(10)->get();

        $response = [
            'exams'           => $exams,
            'currentDateTime' => date('Y-m-d H:i:s'),
            'subjects'        => Subject::withCount('questions')->whereIn('id', $subjectIds)->get()
        ];

        return $this->successResponse($response);
    }

    public function liveExamDetail($id)
    {
        $response = [
            'currentDateTime' => date('Y-m-d H:i:s'),
            'exam' => Exam::withCount('exam_user')->findOrFail($id)
        ];

        return $this->successResponse($response);
    }

    public function subjects()
    {
        $categoryIds = CategoryUser::where('user_id', auth()->id())->pluck('category_id')->toArray();
        $subjectIds = CategorySubject::whereIn('category_id', $categoryIds)->pluck('subject_id')->toArray();
        $subjects = Subject::withCount('questions')->whereIn('id', $subjectIds)->get();
        
        return $this->successResponse($subjects);
    }

    public function subjectExam($subjectId)
    {
        $exams = Exam::withCount(['question_answer', 'questions'])->where([
            'subject_id' => $subjectId, 'exam_type' => ExamType::SUBJECT_BASED, 'status' => Status::PUBLISHED
        ])->get();

        return $this->successResponse($exams);
    }

    public function subjectChapter($subjectId)
    {
        $exams = Exam::where('subject_id', $subjectId)->where(['exam_type' => ExamType::SUBJECT_BASED, 'status' => Status::PUBLISHED])->where('chapter', '!=', null)->get();

        return $this->successResponse($exams);
    }

    public function question($examId)
    {
        $questions = ExamQuestion::where('exam_id', $examId)->get();
        return $this->successResponse($questions);
    }

    public function result($examId)
    {
        $topRanks = ExamMark::where('exam_id', $examId)->groupBy('user_id')->orderByRaw('SUM(right_answer) DESC')->orderBy('total_time', 'asc')->get();

        $rank = $topRanks->search(function ($userRank) {
            return $userRank->user_id === auth()->id();
        });

        $questions = ExamQuestion::with('answer')->where('exam_id', $examId)->get();

        $response = [
            'rank' => $rank,
            'questions' => $questions,
        ];

        return $this->successResponse($response);
    }
}
