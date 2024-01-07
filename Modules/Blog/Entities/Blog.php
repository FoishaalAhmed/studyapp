<?php

namespace Modules\Blog\Entities;

use Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'photo', 'content', 'view', 'status', 'user_id', 'date', 'tag'
    ];


    public function storeBlog(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadFile($image, 'public/images/blogs/', 'blog');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/blogs/' . $response['file_name'];
        }

        $this->title   = $request->title;
        $this->slug    = Str::slug($request->title);
        $this->content = $request->content;
        $this->user_id = auth()->id();
        $this->date    = date('Y-m-d', strtotime($request->date));
        $this->tag     = $request->tag != null
                            ? implode(',', array_column(json_decode($request->tag), 'value'))
                            : null;
        $storeBlog     = $this->save();

        $storeBlog
            ? session()->flash('success', 'New Blog Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateBlog(Object $request, Object $blog)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadFile($image, 'public/images/blogs/', 'blog', $blog->photo);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $blog->photo = 'public/images/blogs/' . $response['file_name'];
        }

        $blog->title   = $request->title;
        $blog->slug    = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->date    = date('Y-m-d', strtotime($request->date));
        $blog->tag     = $request->tag != null
                            ? implode(',', array_column(json_decode($request->tag), 'value'))
                            : null;
        $updateBlog    = $blog->save();

        $updateBlog
            ? session()->flash('success', 'Blog Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyBlog(Object $blog)
    {
        if (file_exists($blog->photo)) unlink($blog->photo);
        $destroyBlog = $blog->save();

        $destroyBlog
            ? session()->flash('success', 'Blog Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
