<?php

namespace Modules\Blog\DataTables;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;
use Modules\Blog\Entities\Blog;
use Str;

class BlogsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('date', function ($blog) {
                return  date('d M, Y', strtotime($blog->date));
            })
            ->addColumn('title', function ($blog) {
                return  $blog->title;
            })
            ->addColumn('status', function ($blog) {
                return  $blog->status;
            })
            ->addColumn('photo', function ($blog) {
                return '<img class="d-flex align-items-start rounded me-2" src="' . asset($blog->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($blog) {
                $status = $blog->status == 'Published' ? '<a href="' . route('admin.blogs.status', [$blog->id, 'In Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>&nbsp;' : '<a href="' . route('admin.blogs.status', [$blog->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>&nbsp;';
                $delete = '<a href="' . route('admin.blogs.destroy', $blog->id) . '" class="btn btn-outline-danger waves-effect waves-light delete-warning"><i class="fe-trash-2"></i></a>';
                return $status . $delete;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Blog::latest('date');
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
                'name' => 'blogs.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'date',
                'name' => 'blogs.date',
                'title' => __('Date')
            ])
            ->addColumn([
                'data' => 'title',
                'name' => 'blogs.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'status',
                'name' => 'blogs.status',
                'title' => __('Status')
            ])
            ->addColumn([
                'data' => 'view',
                'name' => 'blogs.view',
                'title' => __('View')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'blogs.photo',
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
