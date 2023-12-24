<?php

namespace Modules\Exam\Http\Controllers\Writer;

use Modules\Exam\Entities\Exam;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\ExamType;
use Modules\Category\Entities\Category;
use Modules\Exam\Http\Requests\ExamRequest;
use Modules\Exam\DataTables\Writer\ExamsDataTable;

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
        return $dataTable->render('exam::writer.exams.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'types' => ExamType::get(['id', 'name']),
            'categories' => Category::oldest('name')->get(['id', 'name'])
        ];

        return view('exam::writer.exams.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        $exam_id = $this->examModelObject->storeExam($request);
        return redirect()->route('writer.exam-questions.create', ['exam_id' => $exam_id]);
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
        
        return view('exam::writer.exams.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param ExamRequest $request
     * @param Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        $this->examModelObject->updateExam($request, $exam);
        return redirect()->route('writer.exams.index');
    }
}
