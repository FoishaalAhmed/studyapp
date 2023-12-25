<?php

namespace Modules\Exam\Http\Controllers\Writer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\{Exam, ExamQuestion};
use Modules\Exam\Http\Requests\ExamQuestionRequest;
use Modules\Exam\DataTables\Writer\ExamQuestionsDataTable;

class ExamQuestionController extends Controller
{
    protected $examQuestionModelObject;

    public function __construct()
    {
        $this->examQuestionModelObject = new ExamQuestion();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ExamQuestionsDataTable $dataTable)
    {
        $examId = request()->exam_id;

        $writerExam = (new Exam())->checkWriterExam($examId);

        if (! $writerExam) {
            session()->flash('error', __('This exam does not belongs to you.'));
            return redirect()->route('writer.exams.index');
        }

        return $dataTable->render('exam::writer.exam-questions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data = [
            'examId' => request()->exam_id,
            'exams' => Exam::oldest('title')->get(['id', 'title'])
        ];

        return view('exam::writer.exam-questions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamQuestionRequest $request)
    {
        $this->examQuestionModelObject->storeQuestion($request);
        return redirect()->route('writer.exam-questions.index', ['exam_id' => $request->exam_id]);
    }

    /**
     * the specified resource in storage.
     * @param ExamQuestion $question
     * @return Renderable
     */
    public function show(Exam $examQuestion)
    {
        // as we have used resource route and we are in the exam question route but we have passed the exam id instead of exam question id so we renamed the examQuestion variable to exam variable and variable examQuestion actually store the exam data.

        $exam = $examQuestion;

        $data = [
            'examId' => $exam->id,
            'exams' => Exam::oldest('title')->get(['id', 'title']),
            'questions' => ExamQuestion::where('exam_id', $exam->id)->get(),
        ];
        return view('exam::writer.exam-questions.draft-edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param ExamQuestion $question
     * @return Renderable
     */
    public function edit(ExamQuestion $examQuestion)
    {
        $data = [
            'question' => $examQuestion,
            'exams' => Exam::oldest('title')->get(['id', 'title'])
        ];
        return view('exam::writer.exam-questions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param ExamQuestion $question
     * @return \Illuminate\Http\Response
     */
    public function update(ExamQuestionRequest $request, ExamQuestion $examQuestion)
    {
        $this->examQuestionModelObject->updateQuestion($request, $examQuestion);
        return redirect()->route('writer.exam-questions.index', ['exam_id' => $request->exam_id]);
    }

    /**
     * Store the specified resource in storage.
     * @param Request $request
     */
    public function ajaxSave(Request $request)
    {
        Exam::where('id', $request->exam)->update(['draft' => 'Yes']);

        $examQuestion                 = new ExamQuestion();
        $examQuestion->exam_id        = $request->exam;
        $examQuestion->question       = $request->question;
        $examQuestion->answer1        = $request->answer1;
        $examQuestion->answer2        = $request->answer2;
        $examQuestion->answer3        = $request->answer3;
        $examQuestion->answer4        = $request->answer4;
        $examQuestion->correct_answer = $request->correct_answer;
        $examQuestion->user_id        = auth()->id();
        $examQuestion->save();
    }

    public function bulkUpdate(ExamQuestionRequest $request)
    {
        $this->examQuestionModelObject->updateBulkQuestion($request);
        return redirect()->route('writer.exam-questions.index', ['exam_id' => $request->exam_id]);
    }
}
