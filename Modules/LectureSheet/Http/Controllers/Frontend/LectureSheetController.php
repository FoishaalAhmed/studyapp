<?php

namespace Modules\LectureSheet\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use App\Enums\{Status, CategoryType};
use Modules\Subject\Entities\Subject;
use Modules\Category\Entities\ChildCategory;
use Modules\LectureSheet\Entities\LectureSheet;

class LectureSheetController extends Controller
{
    public function index()
    {
        $categories = ChildCategory::where('sub_category_id', request()->category)->pluck('id')->toArray();

        $data = [
            'subjects'   => Subject::withCount('sheets')->latest('sheets_count')->take(10)->get(),
            'sheets'     => LectureSheet::withCount('buys')->with('subject:id,name')->whereIn('child_category_id', $categories)->where('status', Status::PUBLISHED)->latest()->paginate(16),
            'categories' => ChildCategory::withCount('sheets')->where('sub_category_id', request()->category)->whereIn('type', [CategoryType::LectureSheet , CategoryType::CommonLectureSheet])->latest('sheets_count')->take(10)->get(),
        ];

        return view('lecturesheet::frontend.grid', $data);
    }

    public function list()
    {
        $categories = ChildCategory::where('sub_category_id', request()->category)->pluck('id')->toArray();

        $data = [
            'subjects'   => Subject::withCount('sheets')->latest('sheets_count')->take(10)->get(),
            'sheets'     => LectureSheet::withCount('buys')->with('subject:id,name')->whereIn('child_category_id', $categories)->where('status', Status::PUBLISHED)->latest()->paginate(16),
            'categories' => ChildCategory::withCount('sheets')->where('sub_category_id', request()->category)->whereIn('type', [CategoryType::LectureSheet , CategoryType::CommonLectureSheet])->latest('sheets_count')->take(10)->get(),
        ];

        return view('lecturesheet::frontend.list', $data);
    }

    public function categorySheet()
    {
        $categories = ChildCategory::where('id', request()->category)->pluck('sub_category_id')->toArray();

        $data = [
            'subjects'   => Subject::withCount('sheets')->latest('sheets_count')->take(10)->get(),
            'sheets'     => LectureSheet::withCount('buys')->with('subject:id,name')->where('child_category_id', request()->category)->where('status', Status::PUBLISHED)->latest()->paginate(16),
            'categories' => ChildCategory::withCount('sheets')->whereIn('sub_category_id', $categories)->whereIn('type', [CategoryType::LectureSheet , CategoryType::CommonLectureSheet])->latest('sheets_count')->take(10)->get(),
        ];

        return request()->view == 'grid' ? view('lecturesheet::frontend.grid', $data) : view('lecturesheet::frontend.list', $data);
    }

    public function subjectSheet()
    {
        $categories = LectureSheet::where('subject_id', request()->subject)->pluck('child_category_id')->toArray();

        $data = [
            'sheets'     => LectureSheet::withCount('buys')->with('subject:id,name')->where('subject_id', request()->subject)->where('status', Status::PUBLISHED)->latest()->paginate(16),
            'categories' => ChildCategory::withCount('sheets')->whereIn('id', $categories)->whereIn('type', [CategoryType::LectureSheet , CategoryType::CommonLectureSheet])->latest('sheets_count')->take(10)->get(),
            'subjects'   => Subject::withCount('sheets')->latest('sheets_count')->take(10)->get(),
        ];

        return request()->view == 'grid' ? view('lecturesheet::frontend.grid', $data) : view('lecturesheet::frontend.list', $data);
    }

    public function search()
    {
        $categories = LectureSheet::where('chapter', 'like', '%' . request()->search . '%')->pluck('child_category_id')->toArray();

        $data = [
            'subjects'   => Subject::withCount('sheets')->latest('sheets_count')->take(10)->get(),
            'sheets'     => LectureSheet::where('chapter', 'like', '%' . request()->search . '%')->where('status', Status::PUBLISHED)->latest()->paginate(8),
            'categories' => ChildCategory::withCount('sheets')->whereIn('id', $categories)->whereIn('type', [CategoryType::LectureSheet , CategoryType::CommonLectureSheet])->latest('sheets_count')->take(10)->get(),
        ];

        return request()->view == 'grid' ? view('lecturesheet::frontend.grid', $data) : view('lecturesheet::frontend.list', $data);
    }

    public function detail()
    {
        $id    = base64_decode(request()->sheet);
        $sheet = LectureSheet::with(['category:id,name', 'subject:id,name'])->findOrFail($id);

        $data = [
            'sheet'    => $sheet,
            'subjects' => Subject::withCount('sheets')->latest('sheets_count')->take(10)->get(),
            'sheets'   => LectureSheet::where('child_category_id', $sheet->child_category_id)->where('id', '!=', $id)->where('status', Status::PUBLISHED)->latest()->take(3)->get(),
        ];

        return view('lecturesheet::frontend.detail', $data);
    }
}
