<?php

namespace Modules\LectureSheet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Entities\ChildCategory;
use Modules\Category\Entities\SubCategory;
use Modules\LectureSheet\Entities\LectureSheet;
use Modules\LectureSheet\DataTables\LectureSheetsDataTable;
use Modules\Subject\Entities\CategorySubject;
use Modules\Subject\Entities\Subject;

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
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
