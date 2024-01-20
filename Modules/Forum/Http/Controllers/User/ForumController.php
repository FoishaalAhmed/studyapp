<?php

namespace Modules\Forum\Http\Controllers\User;

use Illuminate\Routing\Controller;
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

    public function index()
    {
        $forums = Forum::with(['user', 'comment', 'comment.user'])->latest()->paginate(20);
        return view('forum::user.index', compact('forums'));
    }

    public function loadMore() 
    {
        $forums = Forum::with(['user', 'comment', 'comment.user'])->latest()->paginate(20);
        return view('forum::user.load-more', compact('forums'));
    }
}
