<?php

namespace Modules\Category\Http\Controllers;

use Modules\Category\DataTables\SubCategoriesDataTable; 
use Modules\Category\Http\Requests\SubCategoryRequest;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Entities\CategoryType;
use Modules\Category\Entities\SubCategory;
use Modules\Category\Entities\Category;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

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
        return $dataTable->render('category::sub-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'types' => CategoryType::orderBy('name', 'asc')->get(),
            'categories' => Category::orderBy('name', 'asc')->get(['id', 'name'])
        ];
        return view('category::sub-categories.create', $data);
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
            'categories' => Category::orderBy('name', 'asc')->get(['id', 'name']),
            'types' => CategoryType::orderBy('name', 'asc')->get(['id', 'name'])
        ];
        return view('category::sub-categories.edit', $data);
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
