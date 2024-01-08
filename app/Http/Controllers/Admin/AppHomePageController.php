<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppHomePage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AppHomePageService;

class AppHomePageController extends Controller
{
    private $homepage;

    public function __construct(AppHomePage $homePage)
    {
        $this->homepage = $homePage;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function index(AppHomePageService $appHomePageService)
    {
        $result = $appHomePageService->getAppHomePageData();
        return view('backend.admin.home.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function create(AppHomePageService $appHomePageService)
    {
        $data = $appHomePageService->getHomePageCategories();
        return view('backend.admin.home.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $this->homepage->storeAppHomePage($request);
        return redirect()->route('admin.app-home.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppHomePage  $appHome
     * @return \Illuminate\Http\Response
    */

    public function edit(AppHomePage $appHome, AppHomePageService $appHomePageService)
    {
        $data = $appHomePageService->getAppHomePageEditData($appHome);
        return view('backend.admin.home.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppHomePage  $appHome
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request, AppHomePage $appHome)
    {
        $request->validate($this->homepage::$validatedRules);
        $this->homepage->updateAppHomePage($request, $appHome);
        return redirect()->route('admin.app-home.index');
    }
}
