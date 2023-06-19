<?php

namespace Modules\UserAccess\DataTables;

use Yajra\DataTables\Services\DataTable;
use Modules\UserAccess\Entities\Query;
use Illuminate\Http\JsonResponse;

class UserQueriesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($query) {
                return $query->name;
            })
            ->addColumn('email', function ($query) {
                return $query->email;
            })
            ->addColumn('phone', function ($query) {
                return $query->phone;
            })
            ->addColumn('subject', function ($query) {
                return $query->subject;
            })
            ->addColumn('message', function ($query) {
                return $query->message;
            })
            ->addColumn('action', function ($query) {
                return '<a href="' . route('admin.queries.destroy', $query->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = Query::latest();
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
                'name' => 'queries.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'queries.name',
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'email',
                'name' => 'queries.email',
                'title' => __('Email')
            ])
            ->addColumn([
                'data' => 'phone',
                'name' => 'queries.phone',
                'title' => __('Phone')
            ])
            ->addColumn([
                'data' => 'subject',
                'name' => 'queries.subject',
                'title' => __('Subject')
            ])
            ->addColumn([
                'data' => 'message',
                'name' => 'queries.message',
                'title' => __('Message')
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
