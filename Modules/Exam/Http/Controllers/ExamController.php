<?php

namespace Modules\Exam\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Exam\DataTables\ExamsDataTable;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Exam;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('exam::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('exam::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('exam::edit');
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
