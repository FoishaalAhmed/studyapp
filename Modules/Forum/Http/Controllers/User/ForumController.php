<?php

namespace Modules\Forum\Http\Controllers\User;

use Validator;
use Illuminate\Http\Request;
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
        $forums = Forum::with(['user', 'comment', 'comments', 'comment.user', 'comments.user'])->latest()->paginate(20);
        return view('forum::user.index', compact('forums'));
    }

    public function loadMore() 
    {
        $forums = Forum::with(['user', 'comments', 'comment','comment.user', 'comments.user'])->latest()->paginate(20);
        return view('forum::user.load-more', compact('forums'));
    }

    public function detail(Forum $forum)
    {
        $data = [
            'forum' => $forum->load(['user:id,name,photo']),
            'comments' => ForumComment::with([
                'replies:id,forum_comment_id,reply,photo,created_at,user_id',
                'replies.user:id,name,photo',
                'user:id,name,photo',
            ])->where('forum_id', $forum->id)->latest()->paginate(20)
        ];

        return view('forum::user.detail', $data);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'description' => ['required', 'string'],
            'title'       => ['required', 'string', 'max:190'],
            'tags'        => ['required', 'string', 'max:190'],
            'photo'       => ['mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024,],
        ]);

        $errorArray    = [];
        $successOutput = '';

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $messages) {
                $errorArray[] = $messages;
            }
        } else {
           (new Forum)->storeForum($request);
            $successOutput = '<div class="alert alert-success">Your forum post successful</div>';
        }

        $output = [
            'error'   => $errorArray,
            'success' => $successOutput
        ];

        echo json_encode($output);
    }

    public function storeComment(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'comment' => ['required', 'string'],
            'photo'   => ['mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024,],
        ]);

        $errorArray    = [];
        $successOutput = '';

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $messages) {
                $errorArray[] = $messages;
            }
        } else {
            (new ForumComment)->storeComment($request);
            $successOutput = '<div class="alert alert-success">Comment Successful</div>';
        }

        $output = [
            'error'   => $errorArray,
            'success' => $successOutput
        ];

        echo json_encode($output);
    }

    public function storeReply(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'reply' => ['required', 'string'],
            'photo' => ['mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024,],
        ]);

        $errorArray    = [];
        $successOutput = '';

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $messages) {
                $errorArray[] = $messages;
            }
        } else {
            (new ForumCommentReply)->storeReply($request);
            $successOutput = '<div class="alert alert-success">Reply Done</div>';
        }

        $output = [
            'error'   => $errorArray,
            'success' => $successOutput
        ];

        echo json_encode($output);
    }
}
