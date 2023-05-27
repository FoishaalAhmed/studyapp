<?php

namespace Modules\Page\DataTables;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;
use Modules\Page\Entities\Page;
use Str;

class PagesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('name', function ($writer) {
                return $writer->name;
            })
            ->addColumn('title', function ($writer) {
                return $writer->title;
            })
            ->addColumn('content', function ($writer) {
                return Str::limit($writer->content, 100);
            })
            ->addColumn('photo', function ($writer) {
                return '<img class="d-flex align-items-start rounded me-2" src="'. asset($writer->photo) .'" alt="Dominic Keller" height="48">';
            })
            ->addColumn('action', function ($writer) {
                $edit = '<a href="' . route('admin.pages.edit', $writer->id) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.pages.destroy', $writer->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $edit . $delete;
            })
            ->rawColumns(['photo', 'content', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Page::latest();
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
                'name' => 'pages.id', 
                'title' => __('ID'), 
                'searchable' => false, 
                'visible' => false
            ])
            ->addColumn([
                'data' => 'name', 
                'name' => 'pages.name', 
                'title' => __('Name')
            ])
            ->addColumn([
                'data' => 'title', 
                'name' => 'pages.title', 
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'content', 
                'name' => 'pages.content', 
                'title' => __('Content')
            ])
            ->addColumn([
                'data' => 'photo', 
                'name' => 'pages.photo', 
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
