<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Modules\Blog\Entities\Blog;
use Illuminate\Routing\Controller;
use Modules\Blog\DataTables\Admin\BlogsDataTable;

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
        return $dataTable->render('blog::admin.index');
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
