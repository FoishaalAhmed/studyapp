<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Modules\Job\Entities\Job;
use Modules\Ebook\Entities\Ebook;
use App\Http\Controllers\Controller;
use Modules\Exam\Entities\{ExamQuestion, Exam};
use Modules\LectureSheet\Entities\LectureSheet;
use Modules\Mcq\Entities\{ModelTest, Question};
use Modules\Category\Entities\{ChildCategory, Category};

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'job' => Job::count(),
            'exam' => Exam::count(),
            'ebook' => Ebook::count(),
            'mcq' => ModelTest::count(),
            'question' => Question::count(),
            'category' => Category::count(),
            'exams' => ExamQuestion::count(),
            'sheet' => LectureSheet::count(),
            'jobs' => Job::latest()->take(6)->get(),
            'tests'=> ModelTest::withCount(['questions', 'mark'])->latest()->take(3)->get(),
            'categories' => ChildCategory::withCount('models')->latest('models_count')->take(12)->get(),
            'student' => User::whereHas("roles", function ($query) {$query->where("name", "User");})->count(),
        ];

        return view('frontend.index', $data);
    }
}
