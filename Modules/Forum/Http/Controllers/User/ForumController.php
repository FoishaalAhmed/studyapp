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
        $forums = Forum::with(['user', 'comment', 'comment.user'])->latest()->paginate(20);
        return view('forum::user.index', compact('forums'));
    }

    public function loadMore() 
    {
        $forums = Forum::with(['user', 'comment', 'comment.user'])->latest()->paginate(20);
        return view('forum::user.load-more', compact('forums'));
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
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $errorArray[] = $messages;
            }
        } else {
            $forumObject = new Forum();
            $forumObject->storeForum($request);
            $successOutput = '<div class="alert alert-success">Your forum post successful</div>';
        }

        $output = [
            'error'   => $errorArray,
            'success' => $successOutput
        ];

        echo json_encode($output);
    }
}
