<?php

namespace Modules\Exam\Entities;

use DB, Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id', 'exam_question_id', 'user_id', 'given_answer',
    ];

    public function storeExamQuestionAnswer(Object $request)
    {
        try {
            DB::beginTransaction();
                foreach ($request->given_answer as $key => $value) {
                    if ($value != null || $value != '') {
                        $data[] = [
                            'exam_id' => $request->exam_id,
                            'user_id' => auth()->id(),
                            'given_answer' => $value,
                            'exam_question_id' => $request->exam_question_id[$key],
                            'created_at' => date('Y-m-d h:i:s'),
                            'updated_at' => date('Y-m-d h:i:s'),
                        ];
                    }
                }

                $this->insert($data);
                $marks = new ExamMark();
                $marks->user_id = auth()->id();
                $marks->exam_id = $request->exam_id;
                $marks->right_answer = $request->right_answer;
                $marks->wrong_answer = $request->wrong_answer;
                $marks->total_time = $request->total_time;
                $marks->save();
            DB::commit();

            return 'Exam Answer Submitted Successfully!';
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('Exam Answer');
            Log::info($e->getMessage());
            return 'Something Went Wrong. Try again.';
        }
    }
}
