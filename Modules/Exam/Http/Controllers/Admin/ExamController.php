<?php

namespace Modules\Exam\Http\Controllers\Admin;

use DB, Exception;
use Modules\Exam\Entities\Exam;
use Illuminate\Routing\Controller;
use Modules\Mcq\Entities\Question;
use Modules\Mcq\Entities\ModelTest;
use Modules\Category\Entities\Category;
use Modules\Exam\Http\Requests\ExamRequest;
use Modules\Exam\DataTables\Admin\ExamsDataTable;
use Modules\Exam\Entities\{ExamType, ExamQuestion};

class ExamController extends Controller
{
    protected $examModelObject;

    public function __construct()
    {
        $this->examModelObject = new Exam();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ExamsDataTable $dataTable)
    {
        return $dataTable->render('exam::admin.exams.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! request()->model_test_id) {
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
            'types' => ExamType::get(['id', 'name']),
            'categories' => Category::oldest('name')->get(['id', 'name'])
        ];

        return view('exam::admin.exams.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        try {

            DB::transaction(function() use ($request) {
                $examId = $this->examModelObject->storeExam($request);

                $questions  = Question::where('model_test_id', $request->model_test_id)->get();
                
                foreach ($questions as $value) {
                    $examQuestionData[] = [
                        'exam_id' => $examId,
                        'question' => $value->question,
                        'answer1' => $value->answer1,
                        'answer2' => $value->answer2,
                        'answer3' => $value->answer3,
                        'answer4' => $value->answer4,
                        'correct_answer' => $value->answer,
                        'user_id' => auth()->id(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                ExamQuestion::insert($examQuestionData);
            });
        } catch (Exception $exception) {
            session()->flash('error', 'Something Went Wrong!');
        }

        return redirect()->route('admin.exams.index');

    }

    /**
     * Show the form for editing the specified resource.
     * @param Exam $exam
     * @return Renderable
     */
    public function edit(Exam $exam)
    {
        $data = [
            'exam' => $exam,
            'types' => ExamType::get(['id', 'name']),
            'categories' => Category::oldest('name')->get(['id', 'name']),
            'subjects' => getSubjectsByCategory($exam->category_id)
        ];
        
        return view('exam::admin.exams.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param ExamRequest $request
     * @param Exam $exam
     * @return Renderable
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        $this->examModelObject->updateExam($request, $exam);
        return redirect()->route('admin.exams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $this->examModelObject->destroyExam($exam);
        return redirect()->route('admin.exams.index');
    }

    public function status(Exam $exam, string $status)
    {
        $exam->status = $status;
        $examStatus = $exam->save();

        $examStatus
            ? session()->flash('success', 'Exam Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
        return back();
    }
}
