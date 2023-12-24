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
            ->parameters(dataTableOptions());
    }
}
