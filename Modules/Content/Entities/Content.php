<?php

namespace Modules\Content\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'text', 'category'
    ];

    public function storeContent(Object $request)
    {
        $this->title = $request->title;
        $this->text = $request->text;
        $this->category = $request->category;
        $storeContent = $this->save();

        $storeContent
            ? session()->flash('success', 'New Content Created SuccessfullY!')
            : session()->flash('error', 'Something Went Wrong');
    }

    public function updateContent(Object $request, Object $content)
    {
        $content->title = $request->title;
        $content->text = $request->text;
        $content->category = $request->category;
        $updateContent = $content->save();

        $updateContent
            ? session()->flash('success', 'Content Updated SuccessfullY!')
            : session()->flash('error', 'Something Went Wrong');
    }

    public function destroyContent(Object $content)
    {
        $destroyContent = $content->delete();

        $destroyContent
            ? session()->flash('success', 'Content Deleted SuccessfullY!')
            : session()->flash('error', 'Something Went Wrong');
    }
}
