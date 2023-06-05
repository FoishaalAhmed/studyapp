<?php

namespace Modules\Category\DataTables;

use Modules\Category\Entities\ChildCategory;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class ChildCategoriesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($childCategory) {
                
                return $childCategory->name;
            })
            ->addColumn('subCategory', function ($childCategory) {
                return $childCategory?->subCategory?->name;
            })
            ->addColumn('type', function ($childCategory) {
                return $childCategory?->categoryType?->name;
            })
            ->addColumn('photo', function ($writer) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($writer->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($childCategory) {
                $edit = '<a href="' . route('admin.child-categories.edit', $childCategory->id) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.child-categories.destroy', $childCategory->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $subCategory = request()->category_id;
        $query = !empty($subCategory) 
                    ? ChildCategory::with(['categoryType:id,name', 'subCategory:id,name'])->oldest('name')->where('sub_category_id', $subCategory)
                    : ChildCategory::with(['categoryType:id,name', 'subCategory:id,name'])->oldest('name');
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
                'name' => 'child_categories.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name',
                'name' => 'child_categories.name',
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'subCategory',
                'name' => 'sub_categories.name',
                'title' => __('Category')
            ])
            ->addColumn([
                'data' => 'type',
                'name' => 'category_types.name',
                'title' => __('Type')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'child_categories.photo',
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
