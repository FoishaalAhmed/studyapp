<?php

namespace Modules\Subject\Http\Controllers;

use Modules\Subject\DataTables\SubjectsDataTable;
use Modules\Subject\Http\Requests\SubjectRequest;
use Modules\Subject\Entities\CategorySubject;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Entities\Category;
use Modules\Subject\Entities\Subject;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subjectModelObject;

    public function __construct()
    {
        $this->subjectModelObject = new Subject();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(SubjectsDataTable $dataTale)
    {
        return $dataTale->render('subject::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = Category::oldest('name')->get(['id', 'name']);
        return view('subject::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SubjectRequest $request)
    {
        $this->subjectModelObject->storeSubject($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Subject $subject)
    {
        $data = [
            'subject' => $subject,
            'categories' => Category::oldest('name')->get(['id', 'name']),
            'categoryArray' => CategorySubject::where('subject_id', $subject->id)->pluck('category_id')->toArray()
        ];

        return view('subject::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param SubjectRequest $request
     * @param Subject $subject
     * @return Renderable
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $this->subjectModelObject->updateSubject($request, $subject);
        return redirect()->route('admin.subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Subject $subject
     * @return Renderable
     */
    public function destroy(Subject $subject)
    {
        $this->subjectModelObject->destroySubject($subject);
        return redirect()->route('admin.subjects.index');
    }
}
