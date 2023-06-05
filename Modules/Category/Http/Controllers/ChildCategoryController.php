<?php

namespace Modules\Category\Http\Controllers;

use Modules\Category\DataTables\ChildCategoriesDataTable;
use Modules\Category\Http\Requests\ChildCategoryRequest;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Entities\ChildCategory;
use Modules\Category\Entities\CategoryType;
use Modules\Category\Entities\SubCategory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    protected $childCategoryModelObject;

    public function __construct()
    {
        $this->childCategoryModelObject = new ChildCategory();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ChildCategoriesDataTable $dataTable)
    {
        return $dataTable->render('category::child-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'types' => CategoryType::oldest('name')->get(['id', 'name'])
        ];
        return view('category::child-categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ChildCategoryRequest $request)
    {
        $this->childCategoryModelObject->storeCategory($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param \Modules\Category\Entities\ChildCategory $childCategory
     * @return Renderable
     */
    public function edit(ChildCategory $childCategory)
    {
        $data = [
            'childCategory' => $childCategory,
            'types' => CategoryType::oldest('name')->get(['id', 'name']),
            'categories' => SubCategory::whereType($childCategory->type)->oldest('name')->get(['id', 'name']),
        ];
        return view('category::child-categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param \Modules\Category\Entities\ChildCategory $childCategory
     * @return Renderable
     */
    public function update(ChildCategoryRequest $request, ChildCategory $childCategory)
    {
        $this->childCategoryModelObject->updateCategory($request, $childCategory);
        return redirect()->route('admin.child-categories.index', ['category_id' => $request->sub_category_id]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(ChildCategory $childCategory)
    {
        $this->childCategoryModelObject->destroyCategory($childCategory);
        return back();
    }
}
