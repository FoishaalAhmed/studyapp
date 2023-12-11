<?php

namespace Modules\Content\DataTables;

use Yajra\DataTables\Services\DataTable;
use Modules\Content\Entities\Content;
use Illuminate\Http\JsonResponse;

class ContentsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('title', function ($content) {
                return $content->title;
            })
            ->addColumn('category', function ($content) {
                return $content->category;
            })
            ->addColumn('text', function ($content) {
                return $content->text;
            })
            ->addColumn('action', function ($content) {
                $edit = '<a href="' . route('admin.contents.edit', $content->id) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.contents.destroy', $content->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['text', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Content::select('*');
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
                'name' => 'contents.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'title',
                'name' => 'contents.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'category',
                'name' => 'contents.category',
                'title' => __('Category')
            ])
            ->addColumn([
                'data' => 'text',
                'name' => 'contents.text',
                'title' => __('Text')
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
