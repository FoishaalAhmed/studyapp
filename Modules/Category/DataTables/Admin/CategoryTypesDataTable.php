<?php

namespace Modules\Category\DataTables\Admin;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Services\DataTable;
use Modules\Category\Entities\CategoryType;

class CategoryTypesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($type) {
                return $type->name;
            })
            ->make(true);
    }

    public function query()
    {
        $query = CategoryType::select('*');
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
                'name' => 'category_types.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'category_types.name',
                'title' => __('Name')
            ])
            ->parameters(dataTableOptions());
    }
}
