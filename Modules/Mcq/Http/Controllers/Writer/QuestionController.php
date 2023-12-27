<?php

namespace Modules\Mcq\Http\Controllers\Writer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Mcq\Entities\Question;
use Modules\Mcq\Entities\ModelTest;
use Modules\Mcq\Http\Requests\QuestionRequest;
use Modules\Mcq\DataTables\Writer\QuestionsDataTable;
use Modules\UserAccess\Entities\UserAccess;

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
        $modelTestId = request()->model_test_id;

        $writerMcq = (new ModelTest())->checkWriterMcq($modelTestId);

        if (!$writerMcq) {
            session()->flash('error', __('This mcq does not belongs to you.'));
            return redirect()->route('writer.mcqs.index');
        }

        return $dataTable->render('mcq::writer.questions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'modelTestId' => request()->model_test_id,
            'models'      => ModelTest::where('user_id', auth()->id())->oldest('title')->get(['id', 'title'])
        ];

        return view('mcq::writer.questions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $this->questionModelObject->storeQuestion($request);
        return redirect()->route('writer.mcq-questions.index', ['model_test_id' => $request->model_test_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ModelTest $mcqQuestion)
    {
        // as we have used resource route and we are in the mcq question route but we have passed the mcq id instead of mcq question id so we renamed the mcqQuestion variable to mcq variable and variable mcqQuestion actually store the mcq data.

        $mcq = $mcqQuestion;

        $data = [
            'modelTestId' => $mcq->id,
            'questions'   => Question::where('model_test_id', $mcq->id)->get(),
            'models'      => ModelTest::where('user_id', auth()->id())->oldest('title')->get(['id', 'title'])
        ];

        return view('mcq::writer.questions.draft-edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Question $question
     * @return Renderable
     */
    public function edit(Question $mcqQuestion)
    {
        $data = [
            'question' => $mcqQuestion,
            'models' => ModelTest::oldest('title')->get(['id', 'title'])
        ];

        return view('mcq::writer.questions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $mcqQuestion)
    {
        $this->questionModelObject->updateQuestion($request, $mcqQuestion);
        return redirect()->route('writer.mcq-questions.index', ['model_test_id' => $mcqQuestion->model_test_id]);
    }

    public function bulkUpdate(Request $request)
    {
        $this->questionModelObject->updateModelQuestion($request);
        return redirect()->route('writer.mcq-questions.index', ['model_test_id' => $request->model_test_id]);
    }

    public function ajaxSave(Request $request)
    {

        ModelTest::where('id', $request->model_test)->update(['draft' => 'Yes']);

        $question                = new Question();
        $question->question      = $request->question;
        $question->model_test_id = $request->model_test_id;
        $question->answer        = $request->answer;
        $question->answer1       = $request->answer1;
        $question->answer2       = $request->answer2;
        $question->answer3       = $request->answer3;
        $question->answer4       = $request->answer4;
        $question->explanation   = $request->explanation;
        $question->user_id       = auth()->id();
        $question->save();
    }
}
