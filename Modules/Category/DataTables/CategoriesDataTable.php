<?php

namespace Modules\Category\DataTables;

use Yajra\DataTables\Services\DataTable;
use Modules\Category\Entities\Category;
use Illuminate\Http\JsonResponse;

class CategoriesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($category) {
            return '<a href="' . route('admin.sub-categories.index', ['category_id' => $category->id]) . '">' . $category->name . '</a>';
            })
            ->addColumn('photo', function ($category) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($category->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($category) {
                $edit = '<a href="javascript:;" class="btn btn-outline-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="'.$category->id.'" data-name="'.$category->name.'" data-photo="'.$category->photo.'"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.categories.destroy', $category->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['name', 'photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Category::select('*');
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
                'name' => 'categories.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'categories.name',
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'categories.photo',
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
