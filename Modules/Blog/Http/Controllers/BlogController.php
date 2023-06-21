<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Blog\DataTables\BlogsDataTable;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogObject;

    public function __construct()
    {
        $this->blogObject = new Blog();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(BlogsDataTable $dataTable)
    {
        return $dataTable->render('blog::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('blog::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Blog $blog
     * @return Renderable
     */
    public function destroy(Blog $blog)
    {
        $this->blogObject->destroyBlog($blog);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Blog $blog
     * @param string $status
     * @return Renderable
     */

    public function status(Blog $blog, string $status)
    {
        $blog->status = $status;
        $blogStatus = $blog->save();

        $blogStatus
            ? session()->flash('success', 'Blog Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
        return back();
    }
}
