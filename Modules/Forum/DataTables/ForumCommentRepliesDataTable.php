<?php

namespace Modules\Forum\DataTables;

use Modules\Forum\Entities\ForumCommentReply;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class ForumCommentRepliesDataTable extends DataTable
{
    public function ajax(): JsonResponse
    {
        return datatables()
            ->eloquent($this->query())
            ->addIndexColumn(true)
            ->addColumn('user_id', function ($reply) {
                return optional($reply->user)->name;
            })
            ->addColumn('reply', function ($reply) {
                return $reply->reply;
            })
            ->addColumn('photo', function ($reply) {
            return '<img class="d-flex align-items-start rounded me-2" src="' . asset($reply->photo) . '" alt="Category Photo" height="48">';
            })
            ->addColumn('action', function ($reply) {
            return $reply->status == 'Published' ? '<a href="' . route('admin.forums.reply.status', [$reply->id, 'Review']) . '" class="btn btn-outline-success waves-effect waves-light"><i class="fe-thumbs-up "></i></a>' : '<a href="' . route('admin.forums.reply.status', [$reply->id, 'Published']) . '" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-thumbs-down"></i></a>' ;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }

    public function query()
    {
        $query = ForumCommentReply::with([
            'user:id,name,photo'
        ])->where('forum_comment_id', request()->comment->id);
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
                'name' => '  forum_comment_replies.id',
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
                'data' => 'reply',
                'name' => '  forum_comment_replies.reply',
                'title' => __('Reply')
            ])
            ->addColumn([
                'data' => 'photo',
                'name' => '  forum_comment_replies.photo',
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
