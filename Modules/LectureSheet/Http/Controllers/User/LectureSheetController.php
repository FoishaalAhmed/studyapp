<?php

namespace Modules\LectureSheet\Http\Controllers\User;

use App\Models\Buy;
use Illuminate\Routing\Controller;
use Modules\LectureSheet\Entities\LectureSheet;
use App\Enums\{ContentType, Status, CategoryType};
use Modules\Category\Entities\{CategoryUser, SubCategory, ChildCategory};

class LectureSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categoryId = request()->category_id;
        $sheetIds = Buy::where(['type' => 'sheet', 'user_id' => auth()->id()])->pluck('resource_id')->toArray();

        $data = [
            'sheets' => LectureSheet::with(['subject:id,name', 'category:id,name'])
                    ->where(['child_Category_id' => $categoryId, 'status' => Status::PUBLISHED])
                    ->where(function($query) use($sheetIds) {
                        $query->where('type', ContentType::FREE)->orWhereIn('id', $sheetIds);
                    })->paginate(60)
        ];

        return view('lecturesheet::user.index', $data);
    }

    /**
     * Show all subcategory of lecture sheet for user
     * @return Renderable
     */

    public function allCategory()
    {
        $userCategories = CategoryUser::where('user_id', auth()->id())->pluck('category_id')->toArray();

        $data = [
            'sheetCategories' => SubCategory::withCount(['sheets'])->whereIn('type', [CategoryType::LectureSheet, CategoryType::CommonLectureSheet])->whereIn('category_id', $userCategories)->latest('sheets_count')->paginate(30),
        ];

        return view('lecturesheet::user.sub-category', $data);
    }

    /**
     * Show all subcategory of lecture sheet for user
     * @return Renderable
     */

    public function category(SubCategory $category, string $name)
    {
        $data = [
            'sheetCategories' => ChildCategory::withCount(['sheets'])->whereIn('type', [CategoryType::LectureSheet, CategoryType::CommonLectureSheet])->where('sub_category_id', $category->id)->latest('sheets_count')->paginate(30),
        ];

        return view('lecturesheet::user.category', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param LectureSheet $sheet
     * @return Renderable
     */
    public function read(LectureSheet $sheet)
    {
        return view('lecturesheet::user.read', compact('sheet'));
    }

    public function download(LectureSheet $sheet)
    {
        if (! file_exists($sheet->file)) {
            session()->flash('error', 'File does not exists!');
            return back();
        }

        return response()->download($sheet->file);
    }
}
