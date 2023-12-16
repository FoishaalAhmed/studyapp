<?php

namespace Modules\Mcq\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\{ChildCategory, Subject};

class ModelTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_category_id', 'subject_id', 'user_id', 'title', 'year', 'time', 'type', 'price', 'draft', 'photo', 'description', 'status'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function question_answer()
    {
        return $this->hasMany(ModelQuestionAnswer::class, 'model_test_id')->where('user_id', auth()->id());
    }

    public function category()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function marks()
    {
        return $this->hasOne(ModelMark::class)->where('model_marks.user_id', auth()->id());
    }

    public function mark()
    {
        return $this->hasMany(ModelMark::class);
    }

    public function getModelTestByCategory($category_id)
    {
        $models = $this->with(['category:id,name', 'subject:id,name'])
            ->withCount('questions')
            ->latest()
            ->where('model_tests.child_category_id', $category_id)
            ->get();
        return $models;
    }

    public function getModelTestBySubject($subject_id)
    {
        $models = $this->with(['category:id,name', 'subject:id,name'])
            ->withCount('questions')
            ->latest()
            ->where('model_tests.subject_id', $subject_id)
            ->get();
        return $models;
    }

    public function getModelTests()
    {
        $models = $this->with(['category:id,name', 'subject:id,name'])
            ->withCount('questions')
            ->latest()
            ->get();
        return $models;
    }

    public function storeModelTest(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/models/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->child_category_id = $request->category_id;
        $this->subject_id = $request->subject_id;
        $this->title = $request->title;
        $this->year = $request->year;
        $this->time = $request->time;
        $this->type = $request->type;
        $this->price = $request->price;
        $this->user_id = auth()->id();
        $this->description = $request->description;

        $storeModelTest = $this->save();

        $storeModelTest
            ? session()->flash('success', 'Model Test Created Successfully!') : session()->flash('error', 'Something Went Wrong!');
        return $this->id;
    }

    public function updateModelTest(Object $request, Object $model)
    {
        $image = $request->file('photo');

        if ($image) {
            if (file_exists($model->photo)) unlink($model->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->extension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/models/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $model->photo     = $image_url;
        }

        $model->child_category_id = $request->category_id;
        $model->subject_id = $request->subject_id;
        $model->title = $request->title;
        $model->year = $request->year;
        $model->time = $request->time;
        $model->type = $request->type;
        $model->price = $request->price;
        $model->description = $request->description;
        $updateModelTest = $model->save();

        $updateModelTest
            ? session()->flash('success', 'Model Test Updated Successfully!') : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyModelTest(Object $model)
    {
        if (file_exists($model->photo)) unlink($model->photo);
        $destroyModelTest = $model->delete();

        $destroyModelTest
            ? session()->flash('success', 'Model Test Deleted Successfully!') : session()->flash('error', 'Something Went Wrong!');
    }

    public function getWriterMcqCount($user_id, $start_date = '', $end_date = '')
    {
        $query = $this::where('user_id', $user_id);
        if ($start_date != '' && $end_date != '') {
            $query->whereDate('created_at', '>=', $start_date);
            $query->whereDate('created_at', '<=', $end_date);
        }

        $question = $query->count();

        return $question;
    }
}
