<?php

namespace Modules\Mcq\Http\Controllers\Api;

use App\Enums\CategoryType;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use Modules\Mcq\Entities\{ModelTest, Question};
use Modules\Category\Entities\{ChildCategory, SubCategory};

class McqController extends Controller
{
    public function category()
    {
        $categories = SubCategory::where('type', CategoryType::CommonModelTest)->oldest('name')->get(['id', 'name', 'photo']);
        return $this->successResponse($categories);
    }

    public function premiumSubCategory($categoryId)
    {
        $categories = ChildCategory::where(['type' => CategoryType::ModelTest, 'sub_category_id' => $categoryId])
                    ->oldest('name')->get(['id', 'name', 'photo']);
        return $this->successResponse($categories);
    }

    public function subCategory($categoryId)
    {
        $categories = ChildCategory::withCount(['questions'])->where('sub_category_id', $categoryId)->oldest('name')->get();
        
        return $this->successResponse($categories);
    }

    public function categoryMcq($categoryId)
    {
        $tests = ModelTest::withCount(['question_answer', 'questions'])
                ->with(['marks:id,model_test_id,right_answer,wrong_answer'])
                ->where(['child_category_id' => $categoryId, 'status' => Status::PUBLISHED])->latest()->get();
        
        return $this->successResponse($tests);
    }

    public function subjectMcq($subjectId)
    {
        $tests = ModelTest::withCount(['question_answer', 'questions'])->with(['marks:id,model_test_id,right_answer,wrong_answer'])->where(['subject_id' => $subjectId, 'status' => Status::PUBLISHED])->latest()->get(['id', 'title', 'type', 'year', 'time']);

        return $this->successResponse($tests);
    }

    public function categorySubjectMcq($categoryId, $subjectId)
    {
        $tests = ModelTest::select('id', 'title', 'type', 'year', 'time')
        ->withCount(['question_answer', 'questions'])
        ->with(['marks:id,model_test_id,right_answer,wrong_answer'])
        ->where([
            'child_category_id' => $categoryId,
            'subject_id' => $subjectId,
            'status' => Status::PUBLISHED
        ])
        ->latest()
        ->get();

        
        return $this->successResponse($tests);
    }

    public function questions($mcqId)
    {
        $questions = Question::where('model_test_id', $mcqId)->whereNotNull(['question', 'answer1', 'answer2', 'answer3', 'answer4', 'answer'])->get();

        return $this->successResponse($questions);
    }

    public function search()
    {
        $search = request()->search;

        $tests = ModelTest::withCount(['question_answer', 'questions'])->with(['marks:id,model_test_id,right_answer,wrong_answer'])->where('title', 'like', '%' . $search . '%')->where('status', Status::PUBLISHED)->get();
        
        return $this->successResponse($tests);
    }

    public function result(ModelTest $mcq)
    {
        $questions = Question::with('given_answer')->where('model_test_id', $mcq->id)->whereNotNull(['question', 'answer1', 'answer2', 'answer3', 'answer4', 'answer'])->get();
        
        return $this->successResponse($questions);
    }
}