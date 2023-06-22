<?php

namespace Modules\Subject\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use DB;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'photo'
    ];

    public static $validateRule = [
        'category_ids' => ['required', 'array', 'min:1'],
        'name' => ['required', 'string', 'max:255', 'unique:subjects,name'],
    ];

    public function Categories()
    {
        return $this->hasManyThrough(Category::class, CategorySubject::class, 'subject_id');
    }

    public function questions()
    {
        return $this->hasManyThrough(ExamQuestion::class, Exam::class, 'subject_id');
    }

    public function ebooks()
    {
        return $this->hasMany(Ebook::class, 'subject_id');
    }

    public function sheets()
    {

        return $this->hasMany(LectureSheet::class);
    }

    public function storeSubject(Object $request)
    {
        DB::transaction(function () use ($request) {

            $image = $request->file('photo');

            if ($image) {
                $response = uploadImage($image, 'public/images/subject/', 'subject', '1170*500');

                if (!$response['status']) {
                    session()->flash('error', $response['message']);
                    return;
                }

                $this->photo = 'public/images/subject/' . $response['file_name'];
            }

            $this->name = $request->name;
            $storeSubject = $this->save();

            foreach ($request->category_ids as $key => $value) {
                $data[] = [
                    'subject_id' => $this->id,
                    'category_id' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

            CategorySubject::insert($data);

            $storeSubject
                ? session()->flash('success', 'Subject Created Successfully!')
                : session()->flash('error', 'Something Went Wrong!');
        });
    }

    public function updateSubject(Object $request, Object $subject)
    {
        DB::transaction(function () use ($request, $subject) {

            $exist = $this->where('id', '!=', $subject->id)->where('name', $request->name)->count();
            
            if ($exist != 0) {
                session()->flash('error', 'Subject Already Exists!');
                return redirect()->route('admin.subjects.index');
            }

            $image = $request->file('photo');

            if ($image) {
                $response = uploadImage($image, 'public/images/subject/', 'subject', '1170*500', $subject->photo);

                if (!$response['status']) {
                    session()->flash('error', $response['message']);
                    return;
                }

                $subject->photo = 'public/images/subject/' . $response['file_name'];
            }

            $subject->name = $request->name;
            $updateSubject = $subject->save();

            foreach ($request->category_ids as $key => $value) {
                $data[] = [
                    'subject_id' => $subject->id,
                    'category_id' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            CategorySubject::where('subject_id', $subject->id)->delete();
            CategorySubject::insert($data);

            $updateSubject
                ? session()->flash('success', 'Subject Updated Successfully!')
                : session()->flash('error', 'Something Went Wrong!');
        });
    }

    public function destroySubject(Object $subject)
    {
        if (file_exists($subject->photo)) unlink($subject->photo);
        $destroySubject = $subject->delete();
        $destroySubject
            ? session()->flash('success', 'Subject Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
