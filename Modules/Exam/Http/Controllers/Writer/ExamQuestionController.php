<?php

namespace Modules\Exam\Http\Controllers\Writer;

use Illuminate\Http\Request;
use Modules\Exam\Entities\Exam;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\ExamQuestion;
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
        return $dataTable->render('exam::writer.exam-questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param ExamQuestion $question
     * @return Renderable
     */
    public function edit(ExamQuestion $question)
    {
        $data = [
            'question' => $question,
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
    public function update(ExamQuestionRequest $request, ExamQuestion $question)
    {
        $this->examQuestionModelObject->updateQuestion($request, $question);
        return redirect()->route('writer.exam-questions.index', ['exam_id' => $request->exam_id]);
    }

    /**
     * Remove the specified resource from storage.
     * @param ExamQuestion $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamQuestion $question)
    {
        $this->examQuestionModelObject->destroyQuestion($question);
        return back();
    }
}
