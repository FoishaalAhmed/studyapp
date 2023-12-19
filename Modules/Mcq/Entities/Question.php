<?php

namespace Modules\Mcq\Entities;

use DB;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\UserAccess\Entities\UserLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_test_id', 'question', 'answer1', 'answer2', 'answer3', 'answer4', 'answer', 'explanation', 'user_id',
    ];

    public function model()
    {
        return $this->belongsTo(ModelTest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function given_answer()
    {
        return $this->hasOne(ModelQuestionAnswer::class)->where('user_id', auth()->id());
    }

    public function getQuestionWithModelTest($model_test_id)
    {
        $questions = $this::with(['user'])
            ->join('model_tests', 'questions.model_test_id', '=', 'model_tests.id')
            ->orderBy('questions.model_test_id', 'desc')
            ->orderBy('questions.id', 'asc')
            ->where('questions.model_test_id', $model_test_id)
            ->select('questions.*', 'model_tests.title')
            ->get();
        return $questions;
    }

    public function storeQuestion(Object $request)
    {
        DB::transaction(function () use ($request) {
            ModelTest::where('id', $request->model_test_id)->update(['draft' => 1]);

            $totalQuestion = Question::where('model_test_id', $request->model_test_id)->count();
            foreach ($request->question as $key => $value) {
                if ($key < $totalQuestion) continue;
                $question = new Question();
                $question->question = $value;
                $question->model_test_id = $request->model_test_id;
                $question->answer1 = $request->answer1[$key];
                $question->answer2 = $request->answer2[$key];
                $question->answer3 = $request->answer3[$key];
                $question->answer4 = $request->answer4[$key];
                $question->answer = $request->answer[$key];
                $question->explanation = $request->explanation[$key];
                $question->user_id = auth()->id();
                $question->save();
            }

            $userLog = new UserLog();
            $userLog->user_id = auth()->id();
            $userLog->module = 'inserted ' . count($request->question) . ' mcq question on ' . date('d M, Y');
            $userLog->save();

            session()->flash('success', 'Question Added Successfully!');
        });
    }

    public function updateModelQuestion(Object $request)
    {
        //dd($request);
        DB::transaction(function () use ($request) {
            $totalQuestion = Question::where('model_test_id', $request->model_test_id)->count();
            foreach ($request->question as $key => $value) {
                if ($key < $totalQuestion) continue;
                $question = new Question();
                $question->question = $value;
                $question->model_test_id = $request->model_test_id;
                $question->answer1 = $request->answer1[$key];
                $question->answer2 = $request->answer2[$key];
                $question->answer3 = $request->answer3[$key];
                $question->answer4 = $request->answer4[$key];
                $question->answer = $request->answer[$key];
                $question->explanation = $request->explanation[$key];
                $question->user_id = auth()->id();
                $question->save();
            }

            $userLog = new UserLog();
            $userLog->user_id = auth()->id();
            $userLog->module = 'updated ' . count($request->question) . ' mcq question on ' . date('d M, Y');
            $userLog->save();

            session()->flash('success', 'Question Updated Successfully!');
        });
    }

    public function updateQuestion(Object $request, Object $question)
    {
        DB::transaction(function () use ($request, $question) {
            $question->question = $request->question;
            $question->model_test_id = $request->model_test_id;
            $question->answer1 = $request->answer1;
            $question->answer2 = $request->answer2;
            $question->answer3 = $request->answer3;
            $question->answer4 = $request->answer4;
            $question->answer = $request->answer;
            $question->explanation = $request->explanation;
            $question->save();

            session()->flash('success', 'Question Updated Successfully!');
        });
    }

    public function getWriterQuestionCount($user_id, $start_date = '', $end_date = '')
    {
        $query = $this::where('user_id', $user_id);
        if ($start_date != '' && $end_date != '') {
            $query->whereDate('created_at', '>=', $start_date);
            $query->whereDate('created_at', '<=', $end_date);
        }

        $question = $query->count();

        return $question;
    }

    public function destroyQuestion(Object $question)
    {
        $destroyQuestionTest = $question->delete();

        $destroyQuestionTest
            ? session()->flash('success', 'Question Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
