<?php

namespace Modules\Blog\Http\Controllers\Writer;

use Illuminate\Http\Request;
use Modules\Blog\Entities\Blog;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Blog\Http\Requests\BlogRequest;
use Modules\Blog\DataTables\Writer\BlogsDataTable;

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
        return $dataTable->render('blog::writer.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::writer.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BlogRequest $request)
    {
        $this->blogObject->storeBlog($request);
        return redirect()->route('writer.blogs.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Blog $blog)
    {
        return view('blog::writer.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Blog $blog
     * @return Renderable
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $this->blogObject->updateBlog($request, $blog);
        return redirect()->route('writer.blogs.index');
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
