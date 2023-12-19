<?php

namespace Modules\Exam\Http\Controllers\Admin;

use Modules\Exam\Entities\Exam;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\ExamType;
use Modules\Category\Entities\Category;
use Modules\Exam\Http\Requests\ExamRequest;
use Modules\Exam\DataTables\Admin\ExamsDataTable;

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
