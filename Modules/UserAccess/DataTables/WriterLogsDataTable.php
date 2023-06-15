<?php

namespace Modules\UserAccess\DataTables;

use Yajra\DataTables\Services\DataTable;
use Modules\UserAccess\Entities\UserLog;
use Illuminate\Http\JsonResponse;

class WriterLogsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('user_id', function ($log) {
                return $log?->user?->name;
            })
            ->addColumn('module', function ($log) {

                return $log->module;
            })
            ->addColumn('action', function ($log) {
                return '<a href="' . route('admin.logs.destroy', $log->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $userIds = \App\Models\User::whereHas("roles", function ($q) {
            $q->where("name", "User");
        })->pluck('id')->toArray();

        $query = UserLog::with('user')->whereIn('user_id', $userIds)->latest()->take(100);
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
                'name' => 'user_logs.id',
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
                'data' => 'module',
                'name' => 'user_logs.module',
                'title' => __('Module')
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
