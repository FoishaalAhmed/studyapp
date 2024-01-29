<?php

namespace Modules\Mcq\Http\Controllers\Frontend;

use Modules\Mcq\Entities\ModelTest;
use App\Http\Controllers\Controller;
use App\Enums\{CategoryType, Status};
use Modules\Category\Entities\ChildCategory;

class McqController extends Controller
{
    public function index()
    {
        $categories = ChildCategory::where('sub_category_id', request()->category)->pluck('id')->toArray();

        $data = [
            'categories' => isset(request()->category)
                                ? ChildCategory::withCount('models')->where('sub_category_id', request()->category)->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->latest('models_count')->take(10)->get()
                                : ChildCategory::withCount('models')->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->latest('models_count')->take(10)->get(),

            'mcq' => isset(request()->category) 
                        ? ModelTest::withCount(['questions', 'mark'])->where('status', Status::PUBLISHED)->whereIn('child_category_id', $categories)->latest()->paginate(30) 
                        : ModelTest::withCount(['questions', 'mark'])->where('status', Status::PUBLISHED)->latest()->paginate(30)
        ];

        return view('mcq::frontend.grid', $data);
    }

    public function list()
    {
        $categories = ChildCategory::where('sub_category_id', request()->category)->pluck('id')->toArray();

        $data = [
            'mcq' => isset(request()->category)
                        ? ModelTest::withCount(['questions', 'mark'])->where('status', Status::PUBLISHED)->whereIn('child_category_id', $categories)->latest()->paginate(15)
                        : ModelTest::withCount(['questions', 'mark'])->where('status', Status::PUBLISHED)->latest()->paginate(15),

            'categories' => isset(request()->category)
                                ? ChildCategory::withCount('models')->where('sub_category_id', request()->category)->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->latest('models_count')->take(10)->get()
                                : ChildCategory::withCount('models')->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->latest('models_count')->take(10)->get(),
        ];

        return view('mcq::frontend.list', $data);
    }

    public function search()
    {
        $categories = ModelTest::where('title', 'like', '%' . request()->search . '%')->pluck('child_category_id')->toArray();

        $data = [
            'mcq' => ModelTest::withCount(['questions', 'mark'])->where('title', 'like', '%' . request()->search . '%')->where('status', Status::PUBLISHED)->latest()->paginate(15),
            'categories' => ChildCategory::withCount('models')->whereIn('id', $categories)->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->latest('models_count')->take(10)->get()
        ];

        return request()->view == 'grid' ? view('mcq::frontend.grid', $data) : view('mcq::frontend.list', $data);
    }

    public function categoryMcq()
    {
        $categories = ChildCategory::where('id', request()->category)->pluck('sub_category_id')->toArray();

        $data = [
            'mcq' => ModelTest::withCount(['questions', 'mark'])->where(['child_category_id' => request()->category, 'status' => Status::PUBLISHED])->latest()->paginate(15),
            'categories' => ChildCategory::withCount('models')->whereIn('sub_category_id', $categories)->whereIn('type', [CategoryType::ModelTest, CategoryType::CommonModelTest])->latest('models_count')->take(10)->get()
        ];

        return request()->view == 'grid' ? view('mcq::frontend.grid', $data) : view('mcq::frontend.list', $data);
    }

    public function detail()
    {
        $id = base64_decode(request()->mcq);
        $model = ModelTest::with(['category:id,name', 'subject:id,name'])->withCount(['questions', 'mark'])->findOrFail($id);

        $data = [
            'model'  => $model,
            'models' => ModelTest::with(['category:id,name'])
                ->withCount(['questions', 'mark'])
                ->where('child_category_id', $model->child_category_id)
                ->where('id', '!=', $id)
                ->latest('questions_count')
                ->take(6)
                ->get()
        ];

        return view('mcq::frontend.detail', $data);
    }
}