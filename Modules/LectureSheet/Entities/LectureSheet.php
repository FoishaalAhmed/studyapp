<?php

namespace Modules\LectureSheet\Entities;

use App\Models\Buy;
use Modules\Subject\Entities\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\ChildCategory;

class LectureSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_category_id', 'subject_id', 'chapter', 'file', 'thumb', 'type', 'price', 'status'
    ];

    public function getLectureSheets()
    {
        $models = $this->join('child_categories', 'lecture_sheets.child_category_id', '=', 'child_categories.id')
            ->join('subjects', 'lecture_sheets.subject_id', '=', 'subjects.id')
            ->orderBy('lecture_sheets.created_at', 'desc')
            ->select('lecture_sheets.*', 'child_categories.name as category', 'subjects.name as subject')
            ->get();
        return $models;
    }

    public function buys()
    {
        return $this->hasMany(Buy::class, 'resource_id')->where('type', 'sheet');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function category()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }

    public function storeLectureSheet(Object $request)
    {
        $image = $request->file('file');

        if ($image) {

            $response = uploadFile($image, 'public/images/sheets/', 'sheets');

            if (! $response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->file = 'public/images/sheets/' . $response['file_name'];
        }

        $thumb = $request->file('thumb');

        if ($thumb) {

            $response = uploadImage($thumb, 'public/images/sheets/', 'sheets', '465*260');

            if (! $response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->thumb = 'public/images/sheets/' . $response['file_name'];
        }

        $this->child_category_id = $request->child_category_id;
        $this->subject_id        = $request->subject_id;
        $this->chapter           = $request->chapter;
        $this->type              = $request->type;
        $this->price             = $request->price;
        $storeLectureSheet       = $this->save();

        $storeLectureSheet
            ? session()->flash('success', 'Lecture Sheet Uploaded Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateLectureSheet(Object $request, Object $lecture)
    {
        $image = $request->file('file');

        if ($image) {

            $response = uploadFile($image, 'public/images/sheets/', 'sheets', $lecture->file);
            
            if (! $response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $lecture->file = 'public/images/sheets/' . $response['file_name'];
        }

        $thumb = $request->file('thumb');

        if ($thumb) {

            $response = uploadImage($thumb, 'public/images/sheets/', 'sheets', '465*260', $lecture->thumb);
            
            if (! $response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $lecture->thumb = 'public/images/sheets/' . $response['file_name'];
        }

        $lecture->child_category_id = $request->child_category_id;
        $lecture->subject_id        = $request->subject_id;
        $lecture->chapter           = $request->chapter;
        $lecture->type              = $request->type;
        $lecture->price             = $request->price;
        $updateLectureSheet         = $lecture->save();

        $updateLectureSheet
            ? session()->flash('success', 'Lecture Sheet Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyLectureSheet(Object $lecture)
    {
        if (file_exists($lecture->thumb)) unlink($lecture->thumb);
        if (file_exists($lecture->file)) unlink($lecture->file);
        $destroyLectureSheet = $lecture->delete();

        $destroyLectureSheet
            ? session()->flash('success', 'Lecture Sheet Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
