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
     * Show the form for editing the specified resource.
     * @param ExamQuestion $question
     * @return Renderable
     */
    public function edit(ExamQuestion $ExamQuestion)
    {
        $data = [
            'question' => $ExamQuestion,
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
    public function update(ExamQuestionRequest $request, ExamQuestion $ExamQuestion)
    {
        $this->examQuestionModelObject->updateQuestion($request, $ExamQuestion);
        return redirect()->route('writer.exam-questions.index', ['exam_id' => $request->exam_id]);
    }
}
