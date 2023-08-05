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
            ->addColumn('subject_id', function ($exam) {
                return $exam->subject?->name;
            })
            ->addColumn('title', function ($exam) {
                return  $exam->title;
            })
            ->addColumn('chapter', function ($exam) {
                return  $exam->chapter;
            })
            ->addColumn('type', function ($exam) {
                return  $exam->type;
            })
            ->addColumn('action', function ($exam) {
                $status = $exam->status == 'Published' ? '<a href="' . route('admin.exams.status', [$exam->id, 'In Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>' : '<a href="' . route('admin.exams.status', [$exam->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.exams.destroy', $exam->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $status . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = Exam::with(['category:id,name', 'examType:id,name', 'subject:id,name'])->latest();
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
                'data' => 'subject_id',
                'name' => 'subject.name',
                'title' => __('Subject')
            ])
            ->addColumn([
                'data' => 'title',
                'name' => 'exams.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'chapter',
                'name' => 'exams.chapter',
                'title' => __('Chapter')
            ])
            ->addColumn([
                'data' => 'type',
                'name' => 'exams.type',
                'title' => __('Type')
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
