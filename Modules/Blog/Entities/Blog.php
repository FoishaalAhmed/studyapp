<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'photo', 'content', 'view', 'status', 'user_id', 'date', 'tag'
    ];

    public static $validateRule = [
        'title' => ['required', 'string', 'max:255'],
        'date' => ['required', 'date'],
        'content' => ['required', 'string'],
        'photo' => ['nullable', 'max:1000', 'mimes:jpeg,jpg,png,gif,webp'],
    ];

    public function storeBlog(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/users/';
            $image_url       = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->title   = $request->title;
        $this->slug    = Str::slug($request->title);
        $this->content = $request->content;
        $this->tag     = $request->tag != null
            ? implode(',', array_column(json_decode($request->tag), 'value'))
            : null;
        $this->user_id = auth()->id();
        $this->date    = date('Y-m-d', strtotime($request->date));
        $storeBlog     = $this->save();

        $storeBlog
            ? session()->flash('success', 'New Blog Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateBlog(Object $request, Object $blog)
    {
        $image = $request->file('photo');

        if ($image) {
            if (file_exists($blog->photo)) unlink($blog->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/users/';
            $image_url       = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
            $blog->photo     = $image_url;
        }

        $blog->title   = $request->title;
        $blog->slug    = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->tag     = $request->tag != null
            ? implode(',', array_column(json_decode($request->tag), 'value'))
            : null;
        $blog->date    = date('Y-m-d', strtotime($request->date));
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
