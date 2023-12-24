<?php

namespace Modules\Exam\DataTables\Writer;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;
use Modules\Exam\Entities\Exam;

class ExamsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('category_id', function ($exam) {
                return  $exam->category?->name;
            })
            ->addColumn('exam_type', function ($exam) {
                return  $exam->examType?->name;
            })
            ->addColumn('title', function ($exam) {

                return '<a href="' . route('writer.exam-questions.index', ['exam_id' => $exam->id]) . '">' . $exam->title . '</a>';

                return  $exam->title;
            })
            ->addColumn('type', function ($exam) {
                return  $exam->type;
            })
            ->addColumn('photo', function ($exam) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($exam->photo) . '" alt="Exam Photo" height="48">';
            })
            ->addColumn('action', function ($exam) {

                $status = $exam->draft == 'Yes' ? '<a href="' . route('writer.exams.show', $exam->id) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-help-circle"></i></a>&nbsp;' : '';

                $create = '<a href="' . route('writer.exam-questions.create', $exam->id) . '" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-plus-square"></i></a>&nbsp;';

                $edit = '<a href="' . route('writer.exams.edit', $exam->id) . '" class="btn btn-outline-info waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';

                return $status . $create . $edit;
            })
            ->rawColumns(['title', 'photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Exam::with(['category:id,name', 'examType:id,name'])->where('user_id', auth()->id());

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addIndex([
                'data' => 'DT_RowIndex',
                'name' => 'DT_RowIndex',
                'title' => 'Sl',
                'searchable' => false,
            ])
            ->addColumn([
                'data' => 'id',
                'name' => 'exams.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'category_id',
                'name' => 'category.name',
                'title' => __('Category')
            ])
            ->addColumn([
                'data' => 'exam_type',
                'name' => 'examType.name',
                'title' => __('Type')
            ])
            ->addColumn([
                'data' => 'title',
                'name' => 'exams.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'type',
                'name' => 'exams.type',
                'title' => __('Type')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'exams.photo',
                'title' => __('Photo')
            ])
            ->addColumn([
                'data' => 'action',
                'name' => 'action',
                'title' => __('Action'),
                'orderable' => false,
                'searchable' => false
            ])
            ->parameters(dataTableOptions());
    }
}
