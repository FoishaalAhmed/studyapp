<?php

namespace Modules\Mcq\Http\Controllers\Writer;

use App\Enums\CategoryType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Mcq\Entities\ModelTest;
use Modules\UserAccess\Entities\UserAccess;
use Modules\Mcq\Http\Requests\ModelTestRequest;
use Modules\Mcq\DataTables\Writer\ModelTestsDataTable;
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
        return $dataTable->render('mcq::writer.mcqs.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $childCategoryId = request()->child_category_id;
        $childCategoryIds = UserAccess::where('user_id', auth()->id())->pluck('child_category_id')->toArray();

        $data = [
            'categories' => ChildCategory::whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->whereIn('child_categories.id', $childCategoryIds)->oldest('name')->get(['id', 'name']),
        ];

        return view('mcq::writer.mcqs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ModelTestRequest $request)
    {
        $modelTestId = $this->modelTestModelObject->storeModelTest($request);
        return redirect()->route('writer.mcq-questions.create', ['model_test_id' => $modelTestId]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param ModelTest $mcq
     * @return Renderable
     */
    public function edit(ModelTest $mcq)
    {
        $model = $mcq;

        $child       = ChildCategory::where('id', $model->child_category_id)->firstOrFail(['id', 'sub_category_id', 'name']);
        $category    = SubCategory::where('id', $child->sub_category_id)->firstOrFail(['category_id']);
        $categoryIds = CategorySubject::where('category_id', $category->category_id)->pluck('subject_id')->toArray();

        $data = [
            'model' => $model,
            'subjects' => Subject::whereIn('id', $categoryIds)->orderBy('name')->get(['id', 'name']),
            'categories' => ChildCategory::whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->oldest('name')->get(['id', 'name']),
        ];

        return view('mcq::writer.mcqs.edit', $data);
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
        return redirect()->route('writer.mcqs.index');
    }
}
