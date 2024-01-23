<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Subject\Entities\Subject;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'subject_id', 'exam_type', 'chapter', 'title', 'mark_per_question', 'negative_mark', 'time', 'start_date', 'start_time', 'result_date', 'result_time', 'note',
        'type', 'price', 'photo', 'draft', 'description', 'status', 'user_id', 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'exam_type');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(ExamQuestionAnswer::class);
    }

    public function question_answer()
    {
        return $this->hasMany(ExamQuestionAnswer::class, 'exam_id')->where('user_id', auth()->id());
    }

    public function exam_user()
    {
        return $this->hasOne(ExamUser::class, 'exam_id')->where('user_id', auth()->id());
    }

    public function exam_users()
    {
        return $this->hasMany(ExamUser::class, 'exam_id');
    }

    public function getExams()
    {
        $exams = $this::join('categories', 'exams.category_id', '=', 'categories.id')
            ->join('exam_types', 'exams.exam_type', '=', 'exam_types.id')
            ->leftJoin('subjects', 'exams.subject_id', '=', 'subjects.id')
            ->orderBy('exams.id', 'desc')
            ->orderBy('subjects.name', 'asc')
            ->select('exams.*', 'subjects.name', 'categories.name as category', 'exam_types.name as exam_type')
            ->get();
        return $exams;
    }

    public function getCategoryExams($categoryId)
    {
        $exams = $this::where('exams.category_id', $categoryId)
            ->join('exam_types', 'exams.exam_type', '=', 'exam_types.id')
            ->leftJoin('subjects', 'exams.subject_id', '=', 'subjects.id')
            ->orderBy('exams.id', 'desc')
            ->orderBy('subjects.name', 'asc')
            ->select('exams.*', 'subjects.name', 'exam_types.name as exam_type')
            ->get();
        return $exams;
    }

    public function storeExam(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadFile($image, 'public/images/exams/', 'exam');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $this->photo = 'public/images/exams/' . $response['file_name'];
        }

        $this->category_id = $request->category_id;
        $this->subject_id = $request->exam_type != 1 ? $request->subject_id : null;
        $this->type = $request->type;
        $this->exam_type = $request->exam_type;
        $this->chapter = $request->chapter;
        $this->title = $request->title;
        $this->price = $request->price;
        $this->mark_per_question = $request->mark_per_question;
        $this->negative_mark = $request->negative_mark;
        $this->description = $request->description;
        $this->time = $request->time;
        $this->start_date = date('Y-m-d', strtotime($request->start_date));
        $this->start_time = date('H:i', strtotime($request->start_time));
        $this->result_date = date('Y-m-d', strtotime($request->result_date));
        $this->result_time = date('H:i', strtotime($request->result_time));
        $this->note = $request->note;
        $this->user_id = auth()->id();
        $storeExam = $this->save();

        $storeExam
            ? session()->flash('success', 'Exam Stored Successfully!')
            : session()->flash('error', 'Something Went Wrong!');

        return $this->id;
    }

    public function updateExam(Object $request, Object $exam)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadFile($image, 'public/images/exams/', 'exam', $exam->photo);

            if (! $response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $exam->photo = 'public/images/exams/' . $response['file_name'];
        }

        $exam->subject_id = $request->exam_type != 1 ? $request->subject_id : null;;
        $exam->category_id = $request->category_id;
        $exam->price = $request->price;
        $exam->type = $request->type;
        $exam->exam_type = $request->exam_type;
        $exam->chapter = $request->chapter;
        $exam->title = $request->title;
        $exam->mark_per_question = $request->mark_per_question;
        $exam->negative_mark = $request->negative_mark;
        $this->description = $request->description;
        $exam->time = $request->time;
        $exam->start_date = date('Y-m-d', strtotime($request->start_date));
        $exam->start_time = date('H:i', strtotime($request->start_time));
        $exam->result_date = date('Y-m-d', strtotime($request->result_date));
        $exam->result_time = date('H:i', strtotime($request->result_time));
        $exam->note = $request->exam_type == 1 ? $request->note : null;
        $updateExam = $exam->save();

        $updateExam
            ? session()->flash('success', 'Exam Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyExam(Object $exam)
    {
        if (file_exists($exam->photo)) unlink($exam->photo);
        $destroyExam = $exam->delete();

        $destroyExam
            ? session()->flash('success', 'Exam Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function getWriterExamCount($user_id, $start_date = '', $end_date = '')
    {
        $query = $this::where('user_id', $user_id);
        if ($start_date != '' && $end_date != '') {
            $query->whereDate('created_at', '>=', $start_date);
            $query->whereDate('created_at', '<=', $end_date);
        }

        $question = $query->count();

        return $question;
    }

    public function checkWriterExam($examId)
    {
        $exam = $this->where(['id' => $examId, 'user_id' => auth()->id()])->first();
        return is_null($exam) ? false : true;
    }
}
