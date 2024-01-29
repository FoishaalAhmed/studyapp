<?php

namespace Modules\Exam\Http\Controllers\Frontend;

use App\Enums\Status;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\ExamType;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function index()
    {
        $category = request()->category;

        $data = [
            'types' => ExamType::withCount('exams')->latest('exams_count')->take(10)->get(),
            'exams' => Exam::withCount(['questions', 'exam_users'])->where(['category_id' => $category, 'status' => Status::PUBLISHED])->latest()->paginate(15),
        ];

        return request()->view == 'grid' ? view('exam::frontend.grid', $data) : view('exam::frontend.list', $data);
    }

    public function list()
    {
        $category = request()->category;

        $data = [
            'types' => ExamType::withCount('exams')->latest('exams_count')->take(10)->get(),
            'exams' => Exam::withCount(['questions', 'exam_users'])->where(['category_id' => $category, 'status' => Status::PUBLISHED])->latest()->paginate(15),
        ];

        return view('exam::frontend.list', $data);
    }

    public function typeExam()
    {
        $type = request()->type;

        $data = [
            'types' => ExamType::withCount('exams')->latest('exams_count')->take(10)->get(),
            'exams' => Exam::withCount(['questions', 'exam_users'])->where(['exam_type' => $type, 'status' => Status::PUBLISHED])->latest()->paginate(15),
        ];

        return request()->view == 'grid' ? view('exam::frontend.grid', $data) : view('exam::frontend.list', $data);

    }

    public function search()
    {
        $data = [
            'types' => ExamType::withCount('exams')->latest('exams_count')->take(10)->get(),
            'exams' => Exam::withCount(['questions', 'exam_users'])->where('title', 'like', '%' . request()->search . '%')->where('status', Status::PUBLISHED)->latest()->paginate(15)
        ];

        return request()->view == 'grid' ? view('exam::frontend.grid', $data) : view('exam::frontend.list', $data);
    }

    public function detail()
    {
        $id   = base64_decode(request()->exam);
        $exam = Exam::with(['category:id,name', 'examType:id,name'])->withCount(['questions', 'exam_users'])->findOrFail($id);

        $data = [
            'exam' => $exam,
            'exams' => Exam::where('category_id', $exam->category_id)->where('id', '!=', $id)->where('status', Status::PUBLISHED)->latest()->take(6)->get()
        ];

        return view('exam::frontend.detail', $data);
    }
}
