<?php

namespace Modules\Exam\Http\Controllers;

use Modules\Exam\DataTables\ExamTypesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Modules\Exam\Entities\ExamType;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    protected $examTypeModelObject;

    public function __construct()
    {
        $this->examTypeModelObject = new ExamType();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ExamTypesDataTable $dataTable)
    {
        return $dataTable->render('exam::exam-type');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate(ExamType::$validateRule);
        $this->examTypeModelObject->storeExamType($request);
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $request->validate(ExamType::$validateRule);
        $this->examTypeModelObject->updateExamType($request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param ExamType $examType
     * @return Renderable
     */
    public function destroy(ExamType $examType)
    {
        $this->examTypeModelObject->destroyExamType($examType);
        return back();
    }
}
