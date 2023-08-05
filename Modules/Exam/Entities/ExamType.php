<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max:255']
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'exam_type');
    }

    public function storeExamType(Object $request)
    {
        $this->name = $request->name;
        $storeExamType = $this->save();

        $storeExamType
            ? session()->flash('success', 'New Exam Type Created Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function updateExamType(Object $request)
    {
        $type = $this::findOrFail($request->id);
        $type->name = $request->name;
        $updateExamType = $type->save();

        $updateExamType
            ? session()->flash('success', 'Exam Type Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyExamType(Object $type)
    {
        $destroyExam = $type->delete();

        $destroyExam
            ? session()->flash('success', 'Exam Type Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
