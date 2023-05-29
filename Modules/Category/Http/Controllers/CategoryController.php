<?php

namespace Modules\Category\Http\Controllers;

use Modules\Category\DataTables\CategoriesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Entities\Category;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

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
        $categories = Category::orderBy('name', 'asc')->get();
        return $dataTable->render('category::category', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate(Category::$validateRule);
        $this->categoryModelObject->storeCategory($request);
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate(Category::$validateRule);
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
