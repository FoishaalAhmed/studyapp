<?php

namespace Modules\Subject\DataTables;

use Yajra\DataTables\Services\DataTable;
use Modules\Subject\Entities\Subject;
use Illuminate\Http\JsonResponse;

class SubjectsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($subject) {
                return $subject->name;
            })
            ->addColumn('photo', function ($subject) {
            return '<img class="d-flex align-items-start rounded me-2" src="' . asset($subject->photo) . '" alt="Subject Photo" height="48">';
            })
            ->addColumn('action', function ($subject) {
                $edit = '<a href="' . route('admin.subjects.edit', $subject->id) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.subjects.destroy', $subject->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Subject::oldest('name');
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
                'name' => 'subjects.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'subjects.name',
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'subjects.photo',
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
