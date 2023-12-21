<?php

namespace Modules\Category\DataTables\Admin;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Services\DataTable;
use Modules\Category\Entities\SubCategory;

class SubCategoriesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($subCategory) {
                return '<a href="'. route('admin.child-categories.index', ['category_id' => $subCategory->id]) .'">'. $subCategory->name .'</a>';
            })
            ->addColumn('category_id', function ($subCategory) {
                return $subCategory?->category?->name;
            })
            ->addColumn('type', function ($subCategory) {
                return $subCategory?->categoryType?->name;
            })
            ->addColumn('photo', function ($subCategory) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($subCategory->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($subCategory) {
                $edit = '<a href="' . route('admin.sub-categories.edit', $subCategory->id) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.sub-categories.destroy', $subCategory->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['name', 'photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $category = request()->category_id;

        $query = !empty($category) 
                    ? SubCategory::with(['categoryType:id,name', 'category:id,name'])->where('category_id', $category)
                    : SubCategory::with(['categoryType:id,name', 'category:id,name']);
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
                'name' => 'sub_categories.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'sub_categories.name',
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'category_id',
                'name' => 'category.name',
                'title' => __('Category')
            ])
            ->addColumn([
                'data' => 'type',
                'name' => 'categoryType.name',
                'title' => __('Type')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'sub_categories.photo',
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
