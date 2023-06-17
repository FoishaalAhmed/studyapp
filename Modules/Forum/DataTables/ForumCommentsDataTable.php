<?php

namespace Modules\Forum\DataTables;

use Yajra\DataTables\Services\DataTable;
use Modules\Forum\Entities\ForumComment;
use Illuminate\Http\JsonResponse;

class ForumCommentsDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('user_id', function ($comment) {
                return optional($comment->user)->name;
            })
            ->addColumn('comment', function ($comment) {
                return $comment->comment;
            })
            ->addColumn('vote', function ($comment) {
                return $comment->vote;
            })
            ->addColumn('photo', function ($comment) {
            return '<img class="d-flex align-items-start rounded me-2" src="' . asset($comment->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($comment) {
                $detail = '<a href="' . route('admin.forums.comment.details', $comment->id) . '" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-eye"></i></a>&nbsp;';    
                $status = $comment->status == 'Published' ? '<a href="' . route('admin.forums.comment.status', [$comment->id, 'Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>' : '<a href="' . route('admin.forums.comment.status', [$comment->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>' ;

                return $detail. $status;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = ForumComment::with([
            'user:id,name,photo'
        ])->where('forum_id', request()->forum->id);
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
                'name' => ' forum_comments.id',
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
                'data' => 'comment',
                'name' => ' forum_comments.comment',
                'title' => __('Comment')
            ])
            ->addColumn([
                'data' => 'vote',
                'name' => ' forum_comments.vote',
                'title' => __('Vote')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => ' forum_comments.photo',
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
