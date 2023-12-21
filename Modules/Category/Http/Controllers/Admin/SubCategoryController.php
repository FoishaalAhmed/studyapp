<?php

namespace Modules\Category\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Http\Requests\SubCategoryRequest;
use Modules\Category\DataTables\Admin\SubCategoriesDataTable; 
use Modules\Category\Entities\{CategoryType, SubCategory, Category};

class SubCategoryController extends Controller
{
    protected $subcategoryModelObject;

    public function __construct()
    {
        $this->subcategoryModelObject = new SubCategory();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(SubCategoriesDataTable $dataTable)
    {
        return $dataTable->render('category::admin.sub-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'types' => CategoryType::oldest('name')->get(),
            'categories' => Category::oldest('name')->get(['id', 'name'])
        ];
        return view('category::admin.sub-categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SubCategoryRequest $request)
    {
        $this->subcategoryModelObject->storeCategory($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param \Modules\Category\Entities\SubCategory $subCategory
     * @return Renderable
     */
    public function edit(SubCategory $subCategory)
    {
        $data = [
            'subCategory' => $subCategory,
            'categories' => Category::oldest('name')->get(['id', 'name']),
            'types' => CategoryType::oldest('name')->get(['id', 'name'])
        ];
        return view('category::admin.sub-categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param \Modules\Category\Entities\SubCategory $subCategory
     * @return Renderable
     */
    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $this->subcategoryModelObject->updateCategory($request, $subCategory);
        return redirect()->route('admin.sub-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Modules\Category\Entities\SubCategory $subCategory
     * @return Renderable
     */
    public function destroy(SubCategory $subCategory)
    {
        $this->subcategoryModelObject->destroyCategory($subCategory);
        return back();
    }
}
