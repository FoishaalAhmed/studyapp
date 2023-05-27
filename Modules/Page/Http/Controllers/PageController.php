<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Page\DataTables\PagesDataTable;
use Modules\Page\Http\Requests\PageRequest;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $pageObject;

    public function __construct()
    {
        $this->pageObject = new Page();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PagesDataTable $dataTable)
    {
        return $dataTable->render('page::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('page::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PageRequest $request)
    {
        $this->pageObject->storePage($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Page $page)
    {
        return view('page::edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Page $page
     * @return Renderable
     */
    public function update(PageRequest $request, Page $page)
    {
        $this->pageObject->updatePage($request, $page);
        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Page $page
     * @return Renderable
     */
    public function destroy(Page $page)
    {
        $this->pageObject->destroyPage($page);
        return back();
    }
}
