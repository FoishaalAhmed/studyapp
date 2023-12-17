<?php

namespace Modules\Mcq\Http\Controllers;

use App\Enums\CategoryType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Mcq\Entities\ModelTest;
use Modules\Mcq\DataTables\ModelTestsDataTable;
use Modules\Subject\Entities\{CategorySubject, Subject};
use Modules\Category\Entities\{ChildCategory, SubCategory};
use Modules\Mcq\Http\Requests\ModelTestRequest;

class ModelTestController extends Controller
{
    protected $modelTestModelObject;

    public function __construct()
    {
        $this->modelTestModelObject = new ModelTest();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ModelTestsDataTable $dataTable)
    {
        return $dataTable->render('mcq::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('mcq::create');
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
     * Show the form for editing the specified resource.
     * @param ModelTest $model
     * @return Renderable
     */
    public function edit(ModelTest $model)
    {
        $child        = ChildCategory::where('id', $model->child_category_id)->firstOrFail(['id', 'sub_category_id', 'name']);
        $category     = SubCategory::where('id', $child->sub_category_id)->firstOrFail(['category_id']);
        $category_ids = CategorySubject::where('category_id', $category->category_id)->pluck('subject_id')->toArray();

        $data = [
            'model' => $model,
            'subjects' => Subject::whereIn('id', $category_ids)->orderBy('name')->get(['id', 'name']),
            'categories' => ChildCategory::where('type', CategoryType::ModelTest)->oldest('name')->get(['id', 'name']),
        ];

        return view('mcq::admin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param ModelTest $model
     * @return \Illuminate\Http\Response
     */
    public function update(ModelTestRequest $request, ModelTest $model)
    {
        $this->modelTestModelObject->updateModelTest($request, $model);
        return redirect()->route('admin.mcqs.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param ModelTest $model
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelTest $model)
    {
        $this->modelTestModelObject->destroyModelTest($model);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $status
     * @param  \App\Models\Ebook  $ebook
     */
    public function status(ModelTest $model, $status)
    {
        $model->status = $status;
        $statusChange  = $model->save();

        $statusChange
            ? session()->flash('success', 'Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');

        return back();
    }
}
