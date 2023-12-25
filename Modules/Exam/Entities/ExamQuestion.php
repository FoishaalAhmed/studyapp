<?php

namespace Modules\Exam\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\UserAccess\Entities\UserLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id', 'question', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer', 'user_id',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function answer()
    {
        return $this->hasOne(ExamQuestionAnswer::class)->where('user_id', auth()->id());
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function getQuestionWithExam($exam_id)
    {
        $questions = $this::join('exams', 'exam_questions.exam_id', '=', 'exams.id')
            ->orderBy('exam_questions.exam_id', 'desc')
            ->orderBy('exam_questions.id', 'asc')
            ->where('exam_questions.exam_id', $exam_id)
            ->select('exam_questions.*', 'exams.title')
            ->get();
        return $questions;
    }

    public function storeQuestion(Object $request)
    {
        try {

            if ($request->button == 'draft') {
                Exam::where('id', $request->exam_id)->update(['draft' => 'Yes']);
            }

            $totalQuestion = ExamQuestion::where('exam_id', $request->exam_id)->count();

            foreach ($request->question as $key => $value) {

                if ($key < $totalQuestion) continue;

                $data[] = [
                    'question' => $value,
                    'exam_id' => $request->exam_id,
                    'user_id' => auth()->id(),
                    'answer1' => $request->answer1[$key],
                    'answer2' => $request->answer2[$key],
                    'answer3' => $request->answer3[$key],
                    'answer4' => $request->answer4[$key],
                    'correct_answer' => $request->correct_answer[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

            $this::insert($data);

            $userLog = new UserLog();
            $userLog->user_id = auth()->id();
            $userLog->module = 'inserted ' . count($request->question) . ' exam question on ' . date('d M, Y');
            $userLog->save();

            session()->flash('success', 'Question Added Successfully!');

        } catch (\Exception $exception) {
            session()->flash('error', 'Something Went Wrong!');
        }
        
    }

    public function updateBulkQuestion(Object $request)
    {
        try {
            if ($request->button != 'draft') {
                Exam::where('id', $request->exam_id)->update(['draft' => 'No']);
            }

            $totalQuestion = ExamQuestion::where('exam_id', $request->exam_id)->count();

            foreach ($request->question as $key => $value) {

                if ($key < $totalQuestion) continue;

                $data[] = [
                    'question' => $value,
                    'exam_id' => $request->exam_id,
                    'user_id' => auth()->id(),
                    'answer1' => $request->answer1[$key],
                    'answer2' => $request->answer2[$key],
                    'answer3' => $request->answer3[$key],
                    'answer4' => $request->answer4[$key],
                    'correct_answer' => $request->correct_answer[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

            $this::insert($data);

            $userLog = new UserLog();
            $userLog->user_id = auth()->id();
            $userLog->module = 'updated ' . count($request->question) . ' exam question on ' . date('d M, Y');
            $userLog->save();

            session()->flash('success', 'Question Added Successfully!');

        } catch (\Exception $exception) {
            session()->flash('error', 'Something Went Wrong!');
        }
    }

    public function updateQuestion(Object $request, Object $question)
    {
        $question->question       = $request->question;
        $question->exam_id        = $request->exam_id;
        $question->answer1        = $request->answer1;
        $question->answer2        = $request->answer2;
        $question->answer3        = $request->answer3;
        $question->answer4        = $request->answer4;
        $question->correct_answer = $request->correct_answer;
        $updateQuestion = $question->save();
        
        $updateQuestion
            ? session()->flash('success', 'Question Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function getWriterExamQuestionCount($user_id, $start_date = '', $end_date = '')
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
