<?php

namespace Modules\Category\Http\Controllers;

use Modules\Category\DataTables\CategoryTypesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Entities\CategoryType;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CategoryTypeController extends Controller
{
    protected $categoryModelObject;

    public function __construct()
    {
        $this->categoryModelObject = new CategoryType();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CategoryTypesDataTable $dataTable)
    {
        return $dataTable->render('category::category-type');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate(CategoryType::$validateRule);
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
        $request->validate(CategoryType::$validateRule);
        $this->categoryModelObject->updateCategory($request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryType $categoryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryType $categoryType)
    {
        $this->categoryModelObject->destroyCategory($categoryType);
        return back();
    }
}
