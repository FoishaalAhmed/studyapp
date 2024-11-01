<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppUserChildCategory;
use App\Services\AppUserChildCategoryService;

class AppUserChildCategoryController extends Controller
{
    protected $userChildCategory;

    public function __construct(AppUserChildCategory $userChildCategory)
    {
        $this->userChildCategory = $userChildCategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AppUserChildCategoryService $appUserChildCategoryService)
    {
        $result = $appUserChildCategoryService->getAppUserChildCategories();
        return view('backend.admin.user-child-category.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AppUserChildCategoryService $appUserChildCategoryService)
    {
        $data = $appUserChildCategoryService->getAppUserCategories();
        return view('backend.admin.user-child-category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->userChildCategory->storeAppUserChildCategory($request);
        return redirect()->route('admin.app-user-child-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppUserChildCategory  $appUserChildCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(AppUserChildCategory $appUserChildCategory, AppUserChildCategoryService $appUserChildCategoryService)
    {
        $data = $appUserChildCategoryService->getAppUserChildCategoryEditData($appUserChildCategory);
        return view('backend.admin.user-child-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppUserChildCategory  $appUserChildCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppUserChildCategory $appUserChildCategory)
    {
        $request->validate($this->userChildCategory::$validatedRules);
        $this->userChildCategory->updateAppHomePageCategory($request, $appUserChildCategory);
        return redirect()->route('admin.app-user-child-categories.index');
    }
}
