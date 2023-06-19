<?php

namespace Modules\Job\DataTables;

use Yajra\DataTables\Services\DataTable;
use Modules\Job\Entities\JobCategory;
use Illuminate\Http\JsonResponse;

class JobCategoriesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($jobCategory) {
                return '<a href="' . route('admin.jobs.index', ['job_category_id' => $jobCategory->id]) . '">' . $jobCategory->name . '</a>';
            })
            ->addColumn('photo', function ($jobCategory) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($jobCategory->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($jobCategory) {
                $edit = '<a href="javascript:;" class="btn btn-outline-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="' . $jobCategory->id . '" data-name="' . $jobCategory->name . '" data-photo="' . $jobCategory->photo . '"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.job-categories.destroy', $jobCategory->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['name', 'photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = JobCategory::oldest('name');
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
                'name' => 'job_categories.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'job_categories.name',
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'job_categories.photo',
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
