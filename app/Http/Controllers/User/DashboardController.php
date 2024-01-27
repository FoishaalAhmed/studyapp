<?php

namespace App\Http\Controllers\User;

use App\Models\Buy;
use App\Enums\CategoryType;
use Modules\Mcq\Entities\ModelMark;
use App\Http\Controllers\Controller;
use Modules\Category\Entities\{CategoryUser , SubCategory};

class DashboardController extends Controller
{
    public function index()
    {
        $userCategories  = CategoryUser::where('user_id', auth()->id())->pluck('category_id')->toArray();

        $data = [

            'mcqCategories' => $this->getCategories(
                'models', 
                [CategoryType::ModelTest, CategoryType::CommonModelTest], 
                $userCategories, 
                'models_count'
            ),

            'ebookCategories' => $this->getCategories(
                'ebooks', 
                [CategoryType::Ebook, CategoryType::CommonEbook], 
                $userCategories, 
                'ebooks_count'
            ),

            'sheetCategories' => $this->getCategories(
                'sheets', 
                [CategoryType::LectureSheet, CategoryType::CommonLectureSheet], 
                $userCategories, 
                'sheets_count'
            )
        ];

        return view('backend.user.dashboard', $data);
    }

    public function rank()
    {
        $ranks = ModelMark::with('user')->groupBy('user_id')->orderByRaw('SUM(right_answer) DESC')
        ->oldest('total_time')->take(100)->get();
        return view('backend.user.rank', compact('ranks'));
    }

    public function buy()
    {
        $type      = request()->type ? request()->type : 'mcq';

        $data = [
            'type' => $type,
            'resources' => (new Buy())->getUserResourceBuy($type),
        ];

        return view('backend.user.resource-buy', $data);
    }

    private function getCategories($relation, $type, $categories, $relationCount)
    {
        return SubCategory::withCount($relation)->whereIn('type', $type)->whereIn('category_id', $categories)->latest($relationCount)->take(8)->get();
    }
}
