<?php

namespace App\DataTables\Admin;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;
use App\Models\Buy;

class ResourceSellsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($buy) {
                return $buy->type;
            })
            ->addColumn('user', function ($buy) {
                return $buy->name;
            })
            ->addColumn('resource', function ($buy) {
                return $buy->resource;
            })
            ->addColumn('price', function ($buy) {
                return $buy->price;
            })
            ->addColumn('status', function ($buy) {
                return $buy->status;
            })
            ->addColumn('action', function ($buy) {
                return $buy->status == 'Confirm' ? '<a href="' . route('admin.buys.status', [$buy->id, 'Not Confirm']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>' : '<a href="' . route('admin.buys.status', [$buy->id, 'Confirm']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $type = (isset(request()->type)) ? request()->type : 'mcq';
        $query = (new Buy())->getUserResourceBuyForAdmin($type);
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
                'name' => 'buys.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'type',
                'name' => 'buys.type',
                'title' => __('Type')
            ])
            ->addColumn([
                'data' => 'user',
                'name' => 'buys.user',
                'title' => __('User')
            ])
            ->addColumn([
                'data' => 'resource',
                'name' => 'buys.resource',
                'title' => __('Resource')
            ])
            ->addColumn([
                'data' => 'price',
                'name' => 'buys.price',
                'title' => __('Price')
            ])
            ->addColumn([
                'data' => 'status',
                'name' => 'buys.status',
                'title' => __('Status')
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
