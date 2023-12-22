<?php

namespace Modules\Job\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Job\Entities\JobCategory;
use Modules\Job\Http\Requests\JobCategoryRequest;
use Modules\Job\DataTables\Admin\JobCategoriesDataTable;

class JobCategoryController extends Controller
{
    protected $categoryModelObject;

    public function __construct()
    {
        $this->categoryModelObject = new JobCategory();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(JobCategoriesDataTable $dataTable)
    {
        return $dataTable->render('job::admin.category');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(JobCategoryRequest $request)
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
    public function update(Request $request, $id)
    {
        $this->categoryModelObject->updateCategory($request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param JobCategory $jobCategory
     * @return Renderable
     */
    public function destroy(JobCategory $jobCategory)
    {
        $this->categoryModelObject->destroyCategory($jobCategory);
        return back();
    }
}
