<?php

namespace Modules\Job\DataTables\Writer;

use Illuminate\Http\JsonResponse;
use Modules\Job\Entities\JobUser;
use Yajra\DataTables\Services\DataTable;

class JobAppliesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('job_id', function ($apply) {
                return  $apply?->job?->title;
            })
            ->addColumn('user_id', function ($apply) {
                return $apply?->user?->name;
            })
            ->addColumn('action', function ($apply) {
                return '<a href="' . route('writer.jobs.users.show', ['jobId' => $apply->job_id, 'userId' => $apply->user_id]) . '" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-eye"></i></a>';
            })
            ->rawColumns(['name', 'photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = JobUser::with(['job:id,title', 'user:id,name'])->groupBy('user_id', 'job_id');
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
                'data' => 'job_id',
                'name' => 'job.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'user_id',
                'name' => 'user.name',
                'title' => __('User')
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
