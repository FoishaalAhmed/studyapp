<?php

namespace Modules\LectureSheet\Http\Controllers\Writer;

use App\Enums\CategoryType;
use Illuminate\Routing\Controller;
use Modules\LectureSheet\Entities\LectureSheet;
use Modules\Subject\Entities\{Subject, CategorySubject};
use Modules\Category\Entities\{SubCategory, ChildCategory};
use Modules\LectureSheet\Http\Requests\LectureSheetRequest;
use Modules\LectureSheet\DataTables\Writer\LectureSheetsDataTable;

class LectureSheetController extends Controller
{
    protected $lectureSheetModelObject;

    public function __construct(LectureSheet $lectureSheetModelObject)
    {
        $this->lectureSheetModelObject = $lectureSheetModelObject;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(LectureSheetsDataTable $dataTable)
    {
        return $dataTable->render('lecturesheet::writer.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $subCategoryIds = SubCategory::where('type', [CategoryType::LectureSheet, CategoryType::CommonLectureSheet])->pluck('id')->toArray();

        $data = [
            'categories' => ChildCategory::whereIn('sub_category_id', $subCategoryIds)->oldest('name')->get(['id', 'name'])
        ];
        return view('lecturesheet::writer.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(LectureSheetRequest $request)
    {
        $this->lectureSheetModelObject->storeLectureSheet($request);
        return redirect()->route('writer.lecture-sheets.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param LectureSheet $sheet
     * @return Renderable
     */
    public function edit(LectureSheet $lectureSheet)
    {
        $subCategoryIds = SubCategory::whereIn('type', [CategoryType::LectureSheet, CategoryType::CommonLectureSheet])->pluck('id')->toArray();
        $category     = SubCategory::whereIn('id', $subCategoryIds)->firstOrFail(['category_id']);
        $categoryIds  = CategorySubject::where('category_id', $category->category_id)->pluck('subject_id')->toArray();

        $data = [
            'sheet' => $lectureSheet,
            'subjects' => Subject::whereIn('id', $categoryIds)->oldest('name')->get(['id', 'name']),
            'categories' => ChildCategory::whereIn('sub_category_id', $subCategoryIds)->oldest('name')->get(['id', 'name'])
        ];

        return view('lecturesheet::writer.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param LectureSheetRequest $request
     * @param LectureSheet $sheet
     * @return Renderable
     */
    public function update(LectureSheetRequest $request, LectureSheet $sheet)
    {
        $this->lectureSheetModelObject->updateLectureSheet($request, $sheet);
        return redirect()->route('writer.lecture-sheets.index');
    }

    public function show(LectureSheet $LectureSheet)
    {

        if (! file_exists($LectureSheet->file)) {
            session()->flash('error', 'File does not exists!');
            return back();
        }

        return response()->download($LectureSheet->file);
    }
}
