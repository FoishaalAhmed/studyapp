<?php

namespace Modules\Exam\Http\Controllers\User;

use App\Models\Buy;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\CategoryUser;
use App\Enums\{ContentType, ExamType, Status};
use Modules\Exam\Entities\{Exam, ExamQuestion};

class ExamController extends Controller
{
    protected $examModelObject;

    public function __construct()
    {
        $this->examModelObject = new Exam();
    }

    public function index()
    {
        $data = [
            'liveExams' => $this->returnExams(ExamType::LIVE, false),
            'subjectExams' => $this->returnExams(ExamType::SUBJECT_BASED, false),
            'chapterExams' => $this->returnExams(ExamType::CHAPTER_BASED, false)
        ];

        return view('exam::user.index', $data);
    }

    public function live()
    {
        $exams = $this->returnExams(ExamType::LIVE);
        $title = __('Live Exam');

        return view('exam::user.exam', compact('exams', 'title'));
    }

    public function subject()
    {

        $title = __('Subject Based Exam');
        $exams = $this->returnExams(ExamType::SUBJECT_BASED);

        return view('exam::user.exam', compact('exams', 'title'));
    }

    public function chapter()
    {
        $title = __('Chapter Based Exam');
        $exams = $this->returnExams(ExamType::CHAPTER_BASED);

        return view('exam::user.exam', compact('exams', 'title'));
    }

    public function detail(Exam $exam)
    {
        $data = [
            'questions' => ExamQuestion::where('exam_id', $exam->id)->count(),
            'exam'      => Exam::with(['category:id,name', 'types:id,name', 'subject'])
                            ->withCount(['exam_user', 'exam_users'])->findOrFail($exam->id)
        ];

        return view('exam::user.detail', $data);
    }

    private function returnExams($examType, $paginate = true)
    {
        $today = Date('Y-m-d');
        $categoryIds = CategoryUser::where('user_id', auth()->id())->pluck('category_id')->toArray();
        $examIds = Buy::where(['type' => 'exam', 'user_id' => auth()->id()])->pluck('resource_id')->toArray();

        $exams = Exam::whereIn('category_id', $categoryIds)
            ->where(['exam_type' => $examType, 'status' => Status::PUBLISHED])
            ->where('start_date', '>=', $today)->where(function ($query) use ($examIds) {
                $query->where('type', ContentType::FREE)->orWhereIn('id', $examIds);
            })->latest();

        return $paginate ? $exams->paginate(30) : $exams->take(9)->get();
    }
}
