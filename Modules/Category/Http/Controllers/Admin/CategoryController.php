<?php

namespace Modules\Category\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\CategoryRequest;
use Modules\Category\DataTables\Admin\CategoriesDataTable;

class CategoryController extends Controller
{
    protected $categoryModelObject;

    public function __construct()
    {
        $this->categoryModelObject = new Category();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('category::admin.category');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryModelObject->storeCategory($request);
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryModelObject->updateCategory($request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return Renderable
     */
    public function destroy(Category $category)
    {
        $this->categoryModelObject->destroyCategory($category);
        return back();
    }
}
