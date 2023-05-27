<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'slug', 'content', 'photo'
    ];

    public function storePage(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/pages/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->name = $request->name;
        $this->title = $request->title;
        $this->slug = Str::slug($request->title);
        $this->content = $request->content;
        $storePage  = $this->save();

        $storePage
            ? session()->flash('success', 'New Page Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updatePage(Object $request, Object $page)
    {
        $image = $request->file('photo');

        if ($image) {

            if (file_exists($page->photo)) unlink($page->photo);

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/pages/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $page->photo     = $image_url;
        }

        $page->name = $request->name;
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->content = $request->content;
        $updatePage  = $page->save();

        $updatePage
            ? session()->flash('success', 'Page Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyPage(Object $page)
    {
        if (file_exists($page->photo)) unlink($page->photo);
        $deletePage = $page->delete();

        $deletePage
            ? session()->flash('success', 'Page Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
