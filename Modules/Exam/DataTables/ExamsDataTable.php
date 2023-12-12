<?php

namespace Modules\Exam\DataTables;

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
                return  $exam->title;
            })
            ->addColumn('type', function ($exam) {
                return  $exam->type;
            })
            ->addColumn('photo', function ($exam) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($exam->photo) . '" alt="Exam Photo" height="48">';
            })
            ->addColumn('action', function ($exam) {
                $status = $exam->status == 'Published' ? '<a href="' . route('admin.exams.status', [$exam->id, 'In Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>&nbsp;' : '<a href="' . route('admin.exams.status', [$exam->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>&nbsp;';

                $edit = '<a href="' . route('admin.exams.edit', $exam->id) . '" class="btn btn-outline-info waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';

                $delete = '<a href="' . route('admin.exams.destroy', $exam->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $status . $edit . $delete;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Exam::with(['category:id,name', 'examType:id,name']);
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
