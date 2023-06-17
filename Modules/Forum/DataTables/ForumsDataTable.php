<?php

namespace Modules\Forum\DataTables;

use Yajra\DataTables\Services\DataTable;
use Modules\Forum\Entities\Forum;
use Illuminate\Http\JsonResponse;

class ForumsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('user_id', function ($forum) {
                return optional($forum->user)->name;
            })
            ->addColumn('title', function ($forum) {
                return $forum->title;
            })
            ->addColumn('tags', function ($forum) {
                return $forum->tags;
            })
            ->addColumn('view', function ($forum) {
                return $forum->view;
            })
            ->addColumn('photo', function ($forum) {
            return '<img class="d-flex align-items-start rounded me-2" src="' . asset($forum->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($forum) {
                $detail = '<a href="' . route('admin.forums.details', $forum->id) . '" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-eye"></i></a>&nbsp;';    
                $status = $forum->status == 'Published' ? '<a href="' . route('admin.forums.status', [$forum->id, 'Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>' : '<a href="' . route('admin.forums.status', [$forum->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>' ;

                return $detail. $status;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = Forum::with('user:id,name,photo');
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
                'name' => 'forums.id',
                'title' => __('ID'),
                'searchable' => false,
                'visible' => false
            ])
            ->addColumn([
                'data' => 'user_id',
                'name' => 'user.id',
                'title' => __('User')
            ])
            ->addColumn([
                'data' => 'title',
                'name' => 'forums.title',
                'title' => __('Title')
            ])
            ->addColumn([
                'data' => 'tags',
                'name' => 'forums.tags',
                'title' => __('Tags')
            ])
            ->addColumn([
                'data' => 'view',
                'name' => 'forums.view',
                'title' => __('View')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => 'forums.photo',
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
