<?php

namespace Modules\Exam\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\{Exam, ExamQuestion};
use Modules\Exam\Http\Requests\ExamQuestionRequest;
use Modules\Exam\DataTables\Admin\ExamQuestionsDataTable;

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
        return $dataTable->render('exam::admin.exam-questions.index');
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
        return view('exam::admin.exam-questions.edit', $data);
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
        return redirect()->route('admin.exam-questions.index', ['exam_id' => $request->exam_id]);
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
