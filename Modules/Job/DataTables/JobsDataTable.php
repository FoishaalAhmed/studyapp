<?php

namespace Modules\Job\DataTables;

use Yajra\DataTables\Services\DataTable;
use Modules\Job\Entities\Job;
use Illuminate\Http\JsonResponse;

class JobsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('job_category_id', function ($job) {
                return $job?->category?->name;
            })
            ->addColumn('title', function ($job) {
                return $job->title;
            })
            ->addColumn('company', function ($job) {
                return $job->company;
            })
            ->addColumn('location', function ($job) {
                return $job->location;
            })
            ->addColumn('end_date', function ($job) {
                return date('d M, Y', strtotime($job->end_date));
            })
            ->addColumn('file', function ($job) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($job->photo) . '" alt="Job Photo" height="48">';
            })
            ->addColumn('action', function ($job) {
                return '<a href="' . route('admin.jobs.destroy', $job->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
            })
            ->rawColumns(['file', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = request()->has('job_category_id') ? Job::with(['category:id,name'])->where('job_category_id', request()->job_category_id)->latest() : Job::with('category:id,name')->latest();

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
                'name' => 'jobs.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'job_category_id',
                'name' => 'category.name',
                'title' => __('Category')
            ])
            ->addColumn([
                'data' => 'title',
                'name' => 'jobs.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'company',
                'name' => 'jobs.company',
                'title' => __('Company')
            ])
            ->addColumn([
                'data' => 'location',
                'name' => 'jobs.location',
                'title' => __('Location')
            ])
            ->addColumn([
                'data' => 'end_date',
                'name' => 'jobs.end_date',
                'title' => __('End Date')
            ])
            ->addColumn([
                'data' => 'file',
                'name' => 'jobs.file',
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
