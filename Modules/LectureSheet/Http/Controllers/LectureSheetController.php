<?php

namespace Modules\LectureSheet\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\LectureSheet\Entities\LectureSheet;
use Modules\Subject\Entities\{Subject, CategorySubject};
use Modules\Category\Entities\{SubCategory, ChildCategory};
use Modules\LectureSheet\DataTables\LectureSheetsDataTable;
use Modules\LectureSheet\Http\Requests\LectureSheetRequest;

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
        return $dataTable->render('lecturesheet::index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param LectureSheet $sheet
     * @return Renderable
     */
    public function edit(LectureSheet $sheet)
    {
        $ids          = SubCategory::whereIn('type', ['3', '6'])->pluck('id')->toArray();
        $category     = SubCategory::whereIn('id', $ids)->firstOrFail(['category_id']);
        $category_ids = CategorySubject::where('category_id', $category->category_id)->pluck('subject_id')->toArray();

        $data = [
            'sheet' => $sheet,
            'subjects' => Subject::whereIn('id', $category_ids)->oldest('name')->get(['id', 'name']),
            'categories' => ChildCategory::whereIn('sub_category_id', $ids)->oldest('name')->get(['id', 'name'])
        ];

        return view('lecturesheet::edit', $data);
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
        return redirect()->route('admin.lecture_sheets.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param LectureSheet $sheet
     * @return Renderable
     */
    public function destroy(LectureSheet $sheet)
    {
        $this->lectureSheetModelObject->destroyLectureSheet($sheet);
        return back();
    }

    public function status(LectureSheet $sheet, string $status)
    {
        $sheet->status = $status;
        $sheetStatus = $sheet->save();

        $sheetStatus
            ? session()->flash('success', 'Lecture Sheet Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
        return back();
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
