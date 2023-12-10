<?php

namespace Modules\LectureSheet\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Services\DataTable;
use Modules\LectureSheet\Entities\LectureSheet;

class LectureSheetsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('child_category_id', function ($sheet) {
                return  $sheet->category?->name;
            })
            ->addColumn('subject_id', function ($sheet) {
                return $sheet->subject?->name;
            })
            ->addColumn('chapter', function ($sheet) {
                return  $sheet->chapter;
            })
            ->addColumn('thumb', function ($sheet) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($sheet->thumb) . '" alt="Category Thumb" height="48">';
            })
            ->addColumn('file', function ($sheet) {
                return '<a href="' . route('admin.lecture_sheets.download', $sheet->id) . '" class= "btn btn-soft-primary rounded-pill waves-effect waves-light"><i class= "fe-download"></i></a>';
            })
            ->addColumn('action', function ($sheet) {
                $status = $sheet->status == 'Published' ? '<a href="' . route('admin.lecture_sheets.status', [$sheet->id, 'In Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>&nbsp;' : '<a href="' . route('admin.lecture_sheets.status', [$sheet->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>&nbsp;';
                
                $edit = '<a href="' . route('admin.lecture_sheets.edit', $sheet->id) . '" class="btn btn-outline-info waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';

                $delete = '<a href="' . route('admin.lecture_sheets.destroy', $sheet->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $status . $edit . $delete;
            })
            ->rawColumns(['thumb', 'file', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = LectureSheet::with(['category:id,name', 'subject:id,name'])->latest();
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
                'name' => 'lecture_sheets.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'child_category_id',
                'name' => 'category.name',
                'title' => __('Category')
            ])
            ->addColumn([
                'data' => 'subject_id',
                'name' => 'subject.name',
                'title' => __('Subject')
            ])
            ->addColumn([
                'data' => 'chapter',
                'name' => 'lecture_sheets.chapter',
                'title' => __('Chapter')
            ])
            ->addColumn([
                'data' => 'thumb',
                'name' => 'lecture_sheets.thumb',
                'title' => __('Thumb')
            ])
            ->addColumn([
                'data' => 'file',
                'name' => 'lecture_sheets.file',
                'title' => __('Sheet')
            ])
            ->addColumn([
                'data' => 'type',
                'name' => 'lecture_sheets.type',
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
