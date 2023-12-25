<?php

namespace Modules\Mcq\Http\Controllers\Admin;

use App\Enums\CategoryType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Mcq\Entities\ModelTest;
use Modules\Mcq\Http\Requests\ModelTestRequest;
use Modules\Mcq\DataTables\Admin\ModelTestsDataTable;
use Modules\Subject\Entities\{CategorySubject, Subject};
use Modules\Category\Entities\{ChildCategory, SubCategory};

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
        return $dataTable->render('mcq::admin.mcqs.index');
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
        $categoryIds = CategorySubject::where('category_id', $category->category_id)->pluck('subject_id')->toArray();

        $data = [
            'model' => $model,
            'subjects' => Subject::whereIn('id', $categoryIds)->orderBy('name')->get(['id', 'name']),
            'categories' => ChildCategory::whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->oldest('name')->get(['id', 'name']),
        ];

        return view('mcq::admin.mcqs.edit', $data);
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
