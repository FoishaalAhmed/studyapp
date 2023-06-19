<?php

namespace Modules\Job\DataTables;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;
use Modules\Job\Entities\JobUser;

class ApplyDetailsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('title', function ($apply) {
                return  $apply->title;
            })
            ->addColumn('document', function ($apply) {
                return '<a href="' . asset($apply->document) . '" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-download"></i></a>';
            })
            ->rawColumns(['document'])
            ->make(true);
    }

    public function query()
    {
        $query = JobUser::where(['job_id' => request()->jobId, 'user_id' => request()->userId]);
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
                'name' => 'job_users.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'title',
                'name' => 'job_users.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'document',
                'name' => 'job_users.document',
                'title' => __('Document')
            ])
            ->parameters(dataTableOptions());
    }
}
