<?php

namespace Modules\UserAccess\DataTables;

use Modules\UserAccess\Entities\UserAccess;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class UserPermissionsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('user_id', function ($access) {
                return $access?->user?->name;
            })
            ->addColumn('child_category_id', function ($access) {

                return $access?->category?->name;
            })
            ->addColumn('action', function ($access) {
                return '<a href="' . route('admin.accesses.destroy', $access->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = UserAccess::with(['user:id,name', 'category:id,name']);
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
                'name' => 'user_accesses.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'user_id',
                'name' => 'user.name',
                'title' => __('User')
            ])
            ->addColumn([
                'data' => 'child_category_id',
                'name' => 'user_accesses.module',
                'title' => __('Category')
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
