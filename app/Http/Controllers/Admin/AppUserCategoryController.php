<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AppUserCategory;
use App\Http\Controllers\Controller;
use Modules\Category\Entities\Category;
use App\Services\AppUserCategoryService;

class AppUserCategoryController extends Controller
{
    private $userCategory;

    public function __construct(AppUserCategory $userCategory)
    {
        $this->userCategory = $userCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AppUserCategoryService $appUserCategoryService)
    {
        $result = $appUserCategoryService->getAppUserCategories();
        return view('backend.admin.user-category.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::oldest('name')->get(['id', 'name']),
        ];

        return view('backend.admin.user-category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->userCategory->storeAppUserCategory($request);
        return redirect()->route('admin.app-user-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppUserCategory  $appUserCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(AppUserCategory $appUserCategory, AppUserCategoryService $appUserCategoryService)
    {
        $data = $appUserCategoryService->getAppUserCategoryEditData($appUserCategory);
        return view('backend.admin.user-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppUserCategory  $appUserCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppUserCategory $appUserCategory)
    {
        $request->validate($this->userCategory::$validatedRules);
        $this->userCategory->updateUserCategory($request, $appUserCategory);
        return redirect()->route('admin.app-user-categories.index');
    }
}
