<?php

namespace Modules\Quiz\Http\Controllers\Admin;

use Exception, DB;
use Illuminate\Http\Request;
use Modules\Quiz\Entities\Quiz;
use Illuminate\Routing\Controller;
use Modules\Mcq\Entities\ModelTest;
use Modules\Category\Entities\Category;
use Modules\Quiz\Http\Requests\QuizRequest;
use Modules\Quiz\DataTables\Admin\QuizzesDataTable;

class QuizController extends Controller
{
    private $quizModelObject;

    public function __construct()
    {
        $this->quizModelObject = new Quiz();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(QuizzesDataTable $dataTable)
    {
        return $dataTable->render('quiz::admin.quiz.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        if (!request()->model_test_id) {
            session()->flash('error', __('Model Test Not Found.'));
            return redirect()->route('admin.mcqs.index');
        }

        $model = ModelTest::find(request()->model_test_id);

        if (is_null($model)) {
            session()->flash('error', __('Model Test Not Found.'));
            return redirect()->route('admin.mcqs.index');
        }

        $data = [
            'model' => $model,
            'categories' => Category::oldest('name')->get(['id', 'name'])
        ];

        return view('quiz::admin.quiz.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(QuizRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->quizModelObject->storeQuiz($request);
            });

            session()->flash('success', __('The :x has been saved successfully.', ['x' => __('quiz')]));

        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

        return redirect()->route('admin.quizzes.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Quiz $quiz
     * @return Renderable
     */
    public function edit(Quiz $quiz)
    {
        $data = [
            'quiz' => $quiz,
            'categories' => Category::oldest('name')->get(['id', 'name'])
        ];
        return view('quiz::admin.quiz.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Quiz $quiz
     * @return Renderable
     */
    public function update(QuizRequest $request, Quiz $quiz)
    {
        $this->quizModelObject->updateQuiz($request, $quiz);
        return redirect()->route('admin.quizzes.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Quiz $quiz
     * @return Renderable
     */
    public function destroy(Quiz $quiz)
    {
        $this->quizModelObject->destroyQuiz($quiz);
        return redirect()->route('admin.quizzes.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $status
     * @param  \App\Models\Ebook  $ebook
     */
    public function status(Quiz $quiz, $status)
    {
        $quiz->status = $status;
        $statusChange  = $quiz->save();

        $statusChange
            ? session()->flash('success', 'Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');

        return back();
    }
}
