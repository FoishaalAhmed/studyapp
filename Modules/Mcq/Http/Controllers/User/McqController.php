<?php

namespace Modules\Mcq\Http\Controllers\User;

use App\Enums\CategoryType;
use App\Enums\ContentType;
use App\Enums\Status;
use App\Models\Buy;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Mcq\Entities\ModelTest;
use Modules\Subject\Entities\{CategorySubject, Subject};
use Modules\Category\Entities\{CategoryUser, ChildCategory, SubCategory};
use Modules\Mcq\Entities\ModelQuestionAnswer;
use Modules\Mcq\Entities\Question;

class McqController extends Controller
{
    /*
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categoryId = request()->category_id;
        $mcqIds = Buy::where(['type' => 'mcq', 'user_id' => auth()->id(), 'status' => 'Confirmed'])->pluck('resource_id')->toArray();
        $mcqs = ModelTest::withCount('questions')->with([
            'subject:id,name',
            'marks:id,model_test_id,right_answer,wrong_answer'
        ])->where(['child_Category_id' => $categoryId, 'status' => Status::PUBLISHED])
        ->where(function ($query) use ($mcqIds) {
            $query->where('type', ContentType::FREE)->orWhereIn('id', $mcqIds);
        })->latest()->paginate(30);

        return view('mcq::user.index', compact('mcqs'));
    }

    function allCategory()
    {
        $userCategories  = CategoryUser::where('user_id', auth()->id())->pluck('category_id')->toArray();
        $modelCategories = SubCategory::withCount(['models'])->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->whereIn('category_id', $userCategories)->latest('models_count')->paginate(40);

        return view('mcq::user.sub-category', compact('modelCategories'));
    }

    public function Category(SubCategory $category)
    {
        $modelCategories = ChildCategory::withCount(['models'])->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->where('sub_category_id', $category->id)->latest('models_count')->paginate(40);

        return view('mcq::user.category', compact('modelCategories'));
    }

    public function read(ModelTest $model)
    {
        $questions = Question::where('model_test_id', $model->id)->get();

        return view('mcq::user.read', compact('questions', 'model'));
    }

    public function practice(ModelTest $model)
    {
        $questions = Question::where('model_test_id', $model->id)->get();

        return view('mcq::user.practice', compact('questions', 'model'));
    }

    public function exam(ModelTest $model)
    {
        $questions = Question::where('model_test_id', $model->id)->get();
        return view('mcq::user.exam', compact('questions', 'model'));
    }

    function store(Request $request) 
    {        
        $model = ModelTest::findOrFail($request->model_test_id);

        $hour = round($model->time / 60);
        $minute = $model->time - ($hour * 60);
        $myDateTime = strtotime('+' . $hour . ' hours' . $minute . 'minutes');
        $totalTime = explode(' ', $request->total_time);
        $totalTime = strtotime('+' . $totalTime[0] . ' hours' . $totalTime[1] . 'minutes');
        $request['total_time'] = ($myDateTime - $totalTime) / 60;

        (new ModelQuestionAnswer)->storeModelQuestionAnswer($request);

        session()->flash('success', 'Exam Successfully Completed. Here Is The Results For You');
        return redirect()->route('user.mcq.result', [$model->id, strtolower(str_replace([' ', '_', '&'], '-', $model->title))]);
    }

    function result(ModelTest $model)
    {
        $questions = Question::with('given_answer')->where('model_test_id', $model->id)->get();
        return view('mcq::user.result', compact('questions'));
    }

}
