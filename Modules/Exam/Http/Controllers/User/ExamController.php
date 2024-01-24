<?php

namespace Modules\Exam\Http\Controllers\User;

use App\Models\Buy;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\CategoryUser;
use App\Enums\{ContentType, ExamType, Status};
use Modules\Exam\Entities\{Exam, ExamMark, ExamQuestion, ExamQuestionAnswer, ExamUser};

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

        return view('exam::user.exams', compact('exams', 'title'));
    }

    public function subject()
    {

        $title = __('Subject Based Exam');
        $exams = $this->returnExams(ExamType::SUBJECT_BASED);

        return view('exam::user.exams', compact('exams', 'title'));
    }

    public function chapter()
    {
        $title = __('Chapter Based Exam');
        $exams = $this->returnExams(ExamType::CHAPTER_BASED);

        return view('exam::user.exams', compact('exams', 'title'));
    }

    public function detail(Exam $exam)
    {
        $data = [
            'questions' => ExamQuestion::where('exam_id', $exam->id)->count(),
            'exam'      => Exam::with(['category:id,name', 'examType:id,name', 'subject'])
                            ->withCount(['exam_user', 'exam_users'])->findOrFail($exam->id)
        ];

        return view('exam::user.detail', $data);
    }


    public function enroll($examId)
    {
        ExamUser::storeExamUser($examId);
        session()->flash('success', __('You are enrolled for this exam'));
        return back();
    }

    public function exam(Exam $exam)
    {
        $currentDateTime = date('Y-m-d H:i');
        $examDateTime    = date('Y-m-d H:i', strtotime($exam->start_date . $exam->start_time));
        $fiveMinuteExtra = date("Y-m-d H:i:s", strtotime('+5 minutes', strtotime($examDateTime)));

        if ($currentDateTime < $examDateTime) {

            session()->flash('error', __('You are too early. Exam will Start at :x', ['x' => date('d M, Y h:i A', strtotime($exam->start_date . $exam->start_time))]));
            return back();
        }

        if ($currentDateTime > $fiveMinuteExtra) {
            session()->flash('error', __('You are too late. Exam was start at :x', ['x' => date('d M, Y h:i A', strtotime($exam->start_date . $exam->start_time))]));
            return back();
        }

        $questions = ExamQuestion::where('exam_id', $exam->id)->get();

        return view('exam::user.exam', compact('questions', 'exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $hour = round($exam->time / 60);
        $minute = $exam->time - ($hour * 60);
        $myDateTime = strtotime('+' . $hour . ' hours' . $minute . 'minutes');
        $totalTime = explode(' ', $request->total_time);
        $totalTime = strtotime('+' . $totalTime[0] . ' hours' . $totalTime[1] . 'minutes');
        $request['total_time'] = ($myDateTime - $totalTime) / 60;

        (new ExamQuestionAnswer())->storeExamQuestionAnswer($request);

        session()->flash('success', 'Exam Successfully Completed. Wait For Result Published');
        return redirect()->route('user.exams.index');
    }

    public function result(Exam $exam)
    {
        $topRanks = ExamMark::where('exam_id', $exam->id)->groupBy('user_id')->orderByRaw('SUM(right_answer) DESC')->orderBy('total_time', 'asc')->get();

        $data = [
            'exam' => $exam,
            'authUserMark' => ExamMark::where(['exam_id' => $exam->id, 'user_id' => auth()->id()])->count(),
            'questions' => ExamQuestion::with('answer')->where('exam_id', $exam->id)->get(),
            'rank' => $topRanks->search(function ($userRank) {
                return $userRank->user_id === auth()->id();
            })
        ];

        return view('exam::user.result', $data);
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
