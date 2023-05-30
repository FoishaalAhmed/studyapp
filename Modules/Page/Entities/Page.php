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
            $response = uploadImage($image, 'public/images/pages/', 'page', '1170*500');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/pages/' . $response['file_name'];
        }

        $this->name    = $request->name;
        $this->title   = $request->title;
        $this->slug    = Str::slug($request->title);
        $this->content = $request->content;
        $storePage     = $this->save();

        $storePage
            ? session()->flash('success', 'New Page Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updatePage(Object $request, Object $page)
    {
        $image = $request->file('photo');

        if ($image) {
            $response = uploadImage($image, 'public/images/pages/', 'page', '1170*500', $page->photo);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $page->photo = 'public/images/pages/' . $response['file_name'];
        }

        $page->name    = $request->name;
        $page->title   = $request->title;
        $page->slug    = Str::slug($request->title);
        $page->content = $request->content;
        $updatePage    = $page->save();

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
