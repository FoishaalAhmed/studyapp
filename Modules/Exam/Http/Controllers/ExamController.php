<?php

namespace Modules\Exam\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Exam\DataTables\ExamsDataTable;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Exam;
use Illuminate\Http\Request;
use Modules\Category\Entities\Category;
use Modules\Exam\Entities\ExamType;

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
        return $dataTable->render('exam::exams.index');
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
        
        return view('exam::exams.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
