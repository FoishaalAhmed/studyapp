<?php

namespace App\Http\Controllers\Admin;

use App\Services\AppHomePageCategoryService;
use App\Http\Controllers\Controller;
use App\Models\AppHomePageCategory;
use Illuminate\Http\Request;

class AppHomePageCategoryController extends Controller
{
    protected $homePageCategory;

    public function __construct(AppHomePageCategory $homePageCategory)
    {
        $this->homePageCategory = $homePageCategory;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AppHomePageCategoryService $appHomePageCategoryService)
    {
        $result = $appHomePageCategoryService->getAppHomePageCategories();

        return view('backend.super-admin.home-page-category.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AppHomePageCategoryService $appHomePageCategoryService)
    {
        $data = $appHomePageCategoryService->getAppHomePageSubCategories();

        return view('backend.super-admin.home-page-category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->homePageCategory->storeAppHomePageCategory($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppHomePageCategory  $appHomeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(AppHomePageCategory $appHomeCategory, AppHomePageCategoryService $appHomePageCategoryService)
    {
        $data = $appHomePageCategoryService->getAppHomePageEditData($appHomeCategory);

        return view('backend.super-admin.home-page-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppHomePageCategory  $appHomeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppHomePageCategory $appHomeCategory)
    {
        $request->validate($this->homePageCategory::$validatedRules);
        $this->homePageCategory->updateAppHomePageCategory($request, $appHomeCategory);
        return back();
    }
}
