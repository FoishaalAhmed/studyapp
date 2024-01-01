<?php

namespace Modules\Quiz\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;
use Modules\Mcq\Entities\Question;
use Modules\Quiz\Services\QuizService;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'type', 'price', 'status', 'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }

    public function storeQuiz(object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadImage($image, 'public/images/quizzes/', 'quiz', '465*260');

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $quizPhoto = 'public/images/quizzes/' . $response['file_name'];
        }

        $quizId = Quiz::insertGetId(array_merge(
            $request->validated(),
            [
                'price'      => $request->type == 'Premium' ? $request->price : 0,
                'photo'      => isset($quizPhoto) ? $quizPhoto : null,
                'user_id'    => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ));

        $questions = (new Question)->getQuestionWithModelTest($request->model_test_id);
        $quizQuestionData = (new QuizService)->quizQuestionData($questions, $quizId);
        QuizQuestion::insert($quizQuestionData);
        QuizQuestion::where('quiz_id', $quizId)->first()->update(['level' => 1]);
    }

    public function updateQuiz(object $request, object $quiz)
    {
        $image = $request->file('photo');

        if ($image) {

            $response = uploadImage($image, 'public/images/quizzes/', 'quiz', '465*260', $quiz->photo);

            if (!$response['status']) {
                session()->flash('error', $response['message']);
                return;
            }

            $quiz->photo = 'public/images/quizzes/' . $response['file_name'];
        }

        $quiz->category_id = $request->category_id;
        $quiz->title = $request->title;
        $quiz->type = $request->type;
        $quiz->price = $request->type == 'Premium' ? $request->price : 0;
        $quiz->status = $request->status;
        $updateQuiz = $quiz->save();

        $updateQuiz
            ? session()->flash('success', 'Quiz Updated Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyQuiz(Object $quiz)
    {
        if (file_exists($quiz->photo)) unlink($quiz->photo);
        $destroyQuiz = $quiz->delete();

        $destroyQuiz
            ? session()->flash('success', 'Quiz Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
