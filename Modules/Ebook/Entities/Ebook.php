<?php

namespace Modules\Ebook\Entities;

use App\Models\Buy;
use Modules\Subject\Entities\Subject;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\ChildCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_category_id', 'subject_id', 'title', 'thumb', 'book', 'type', 'price'
    ];

    public function category()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function buys()
    {
        return $this->hasMany(Buy::class, 'resource_id')->where('type', 'ebook');
    }

    public function getEbooks()
    {
        return $this->join('child_categories', 'ebooks.child_category_id', '=', 'child_categories.id')
            ->leftJoin('subjects', 'ebooks.subject_id', '=', 'subjects.id')
            ->orderBy('ebooks.created_at', 'desc')
            ->select('ebooks.*', 'child_categories.name as category', 'subjects.name as subject')
            ->get();
    }

    public function storeEbook(Object $request)
    {
        $book = $request->file('book');

        if ($book) {

            $response = uploadFile($book, 'public/images/ebooks/', 'ebook',);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->file = 'public/images/ebooks/' . $response['file_name'];
        }

        $thumb = $request->file('thumb');

        if ($thumb) {

            $response = uploadImage($thumb, 'public/images/ebooks/', 'thumb', '465*260');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->thumb = 'public/images/ebooks/' . $response['file_name'];
        }

        $this->child_category_id = $request->child_category_id;
        $this->subject_id = $request->subject_id;
        $this->title = $request->title;
        $this->type = $request->type;
        $this->price = $request->price;
        $storeEbook = $this->save();

        $storeEbook
            ? session()->flash('success', 'Ebook Uploaded Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateEbook(Object $request, Object $ebook)
    {
        $book = $request->file('book');

        if ($book) {

            $response = uploadFile($book, 'public/images/ebooks/', 'ebook', $ebook->book);

            if (! $response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $ebook->file = 'public/images/ebooks/' . $response['file_name'];
        }

        $thumb = $request->file('thumb');

        if ($thumb) {

            $response = uploadImage($thumb, 'public/images/ebooks/', 'thumb', '465*260', $ebook->thumb);

            if (! $response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $ebook->thumb = 'public/images/ebooks/' . $response['file_name'];
        }

        $ebook->child_category_id = $request->child_category_id;
        $ebook->subject_id = $request->subject_id;
        $ebook->title = $request->title;
        $ebook->type = $request->type;
        $ebook->price = $request->price;
        $updateEbook = $ebook->save();

        $updateEbook
            ? session()->flash('success', 'Ebook Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyEbook(Object $lecture)
    {
        if (file_exists($lecture->thumb)) unlink($lecture->thumb);
        if (file_exists($lecture->book)) unlink($lecture->book);
        $destroyEbook = $lecture->delete();

        $destroyEbook
            ? session()->flash('success', 'Ebook Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
