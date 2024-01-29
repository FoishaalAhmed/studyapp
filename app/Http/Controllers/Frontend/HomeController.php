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
            'job' => isActive('Job') ? Job::count() : 0,
            'exam' => Exam::count(),
            'ebook' => isActive('Ebook') ? Ebook::count() : 0,
            'mcq' => ModelTest::count(),
            'question' => Question::count(),
            'category' => Category::count(),
            'exams' => ExamQuestion::count(),
            'sheet' => isActive('LectureSheet') ? LectureSheet::count() : 0,
            'jobs' => isActive('Job') ? Job::latest()->take(6)->get() : [],
            'mcqs'=> ModelTest::withCount(['questions', 'mark'])->latest()->take(6)->get(),
            'categories' => ChildCategory::withCount('models')->latest('models_count')->take(12)->get(),
            'student' => User::whereHas("roles", function ($query) {$query->where("name", "User");})->count(),
        ];

        return view('frontend.index', $data);
    }
}
