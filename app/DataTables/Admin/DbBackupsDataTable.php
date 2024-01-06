<?php

namespace App\DataTables\Admin;

use App\Models\DbBackup;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Services\DataTable;

class DbBackupsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($backup) {
                return $backup->name;
            })
            ->addColumn('created_at', function ($backup) {
                return date('d M, Y h:i A', strtotime($backup->created_at));
            })
            
            ->addColumn('action', function ($backup) {
                return '<a href="' . route('admin.backups.download', $backup->id) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-download"></i></a>&nbsp;';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = DbBackup::select('*');
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
                'name' => 'db_backups.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'db_backups.name',
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'created_at',
                'name' => 'db_backups.created_at',
                'title' => __('Backup At')
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
