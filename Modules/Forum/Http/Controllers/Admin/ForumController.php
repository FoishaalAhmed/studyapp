<?php

namespace Modules\Forum\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Forum\DataTables\{
    ForumCommentRepliesDataTable,
    ForumCommentsDataTable,
    ForumsDataTable
};
use Modules\Forum\Entities\{
    ForumCommentReply,
    ForumComment,
    Forum
};

class ForumController extends Controller
{
    protected $forumModelObject;

    public function __construct()
    {
        $this->forumModelObject = new Forum();
    }

    public function index(ForumsDataTable $dataTable)
    {
        return $dataTable->render('forum::admin.index');
    }

    public function forumStatus(Forum $forum, string $status)
    {
        $forum->status = $status;
        $forumStatus = $forum->save();

        $forumStatus
            ? session()->flash('success', 'Forum Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
        return back();
    }

    public function details(ForumCommentsDataTable $dataTable, Forum $forum)
    {
        return $dataTable->render('forum::admin.comment');
    }

    public function commentStatus(ForumComment $comment, string $status)
    {
        $comment->status = $status;
        $commentStatus = $comment->save();

        $commentStatus
            ? session()->flash('success', 'Forum Comment Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function commentDetail(ForumCommentRepliesDataTable $dataTable, ForumComment $comment)
    {
        return $dataTable->render('forum::admin.reply');
    }

    public function replyStatus(ForumCommentReply $reply, string $status)
    {
        $reply->status = $status;
        $replyStatus = $reply->save();

        $replyStatus
            ? session()->flash('success', 'Forum Comment Reply Status Changed Successfully!')
            : session()->flash('error', 'Something Went Wrong!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        $this->forumModelObject->destroyForum($forum);
        return back();
    }
}
