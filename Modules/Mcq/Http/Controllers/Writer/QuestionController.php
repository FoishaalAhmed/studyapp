<?php

namespace Modules\Mcq\Http\Controllers\Writer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Mcq\Entities\Question;
use Modules\Mcq\Entities\ModelTest;
use Modules\Mcq\Http\Requests\QuestionRequest;
use Modules\Mcq\DataTables\Writer\QuestionsDataTable;

class QuestionController extends Controller
{
    protected $questionModelObject;

    public function __construct()
    {
        $this->questionModelObject = new Question();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(QuestionsDataTable $dataTable)
    {
        return $dataTable->render('mcq::admin.questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Question $question
     * @return Renderable
     */
    public function edit(Question $question)
    {
        $data = [
            'question' => $question,
            'models' => ModelTest::oldest('title')->get(['id', 'title'])
        ];

        return view('mcq::admin.questions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $this->questionModelObject->updateQuestion($request, $question);
        return redirect()->route('admin.questions.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->questionModelObject->destroyQuestion($question);
        return back();
    }
}
