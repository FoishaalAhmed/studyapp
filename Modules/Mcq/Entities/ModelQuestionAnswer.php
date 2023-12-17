<?php

namespace Modules\Mcq\Entities;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['model_test_id', 'question_id', 'given_answer', 'user_id'];

    public function storeModelQuestionAnswer(Object $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->given_answer as $key => $value) {
                if ($value != null || $value != '') {
                    $data[] = [
                        'model_test_id' => $request->model_test_id,
                        'user_id' => auth()->id(),
                        'given_answer' =>  $value,
                        'question_id' => $request->question_id[$key],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
            }

            $this->insert($data);
            $marks = new ModelMark();
            $marks->user_id = auth()->id();
            $marks->model_test_id = $request->model_test_id;
            $marks->right_answer = $request->right_answer;
            $marks->wrong_answer = $request->wrong_answer;
            $marks->total_time = $request->total_time;
            $marks->save();
            DB::commit();

            return 'MCQ Answer Submitted Successfully!';
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info('Exam Answer');
            \Log::info($e->getMessage());
            return 'Something Went Wrong. Try again.';
        }
    }
}
