<?php

namespace Modules\Exam\DataTables\Admin;

use Yajra\DataTables\Services\DataTable;
use Modules\Exam\Entities\ExamType;
use Illuminate\Http\JsonResponse;

class ExamTypesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($type) {
                return  $type->name;
            })
            ->addColumn('action', function ($type) {
                $edit = '<a href="javascript:;" class="btn btn-outline-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="' . $type->id . '" data-name="' . $type->name . '"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.exam-types.destroy', $type->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = ExamType::select('*');
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
                'name' => 'exam_types.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'exam_types.name',
                'title' => __('Name')
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
