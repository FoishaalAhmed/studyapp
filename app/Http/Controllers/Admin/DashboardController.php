<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Modules\Job\Entities\Job;
use Modules\Ebook\Entities\Ebook;
use App\Http\Controllers\Controller;
use Modules\Category\Entities\Category;
use Modules\Exam\Entities\{Exam, ExamQuestion};
use Modules\LectureSheet\Entities\LectureSheet;
use Modules\Mcq\Entities\{ModelTest, Question};

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'exams' => Exam::count(),
            'mcq' => ModelTest::count(),
            'questions' => Question::count(),
            'examQuestions' => ExamQuestion::count(),
            'jobs' => isActive('Job') ? Job::count() : 0,
            'ebooks' => isActive('Ebook') ? Ebook::count() : 0,
            'sheets' => isActive('LectureSheet') ? LectureSheet::count() : 0,
            'students' => User::whereHas("roles", fn($query) => [
                $query->where("name", "User")
            ])->count(),
        ];

        return view('backend.admin.dashboard', $data);
    }
}
