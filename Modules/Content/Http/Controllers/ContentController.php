<?php

namespace Modules\Content\Http\Controllers;

use Modules\Content\DataTables\ContentsDataTable;
use Modules\Content\Http\Requests\ContentRequest;
use Illuminate\Contracts\Support\Renderable;
use Modules\Content\Entities\Content;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    protected $contentModelObject;

    public function __construct()
    {
        $this->contentModelObject = new Content();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ContentsDataTable $dataTable)
    {
        return $dataTable->render('content::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('content::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ContentRequest $request)
    {
        $this->contentModelObject->storeContent($request);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param Content $content
     * @return Renderable
     */
    public function edit(Content $content)
    {
        return view('content::edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Content $content
     * @return Renderable
     */
    public function update(Request $request, Content $content)
    {
        $this->contentModelObject->updateContent($request, $content);
        return redirect()->route('admin.contents.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Content $content
     * @return Renderable
     */
    public function destroy(Content $content)
    {
        $this->contentModelObject->destroyContent($content);
        return back();
    }
}
