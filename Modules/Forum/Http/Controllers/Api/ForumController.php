<?php

namespace Modules\Forum\Http\Controllers\Api;

use Modules\Forum\Entities\Forum;
use App\Http\Controllers\Controller;
use Modules\Forum\Entities\ForumComment;
use Modules\Forum\Http\Requests\Api\ForumRequest;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::with(['user', 'comments.user'])->latest()->paginate(20);
        return $this->successResponse($forums);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRequest $request)
    {
        try {
            (new Forum)->storeForum($request);
            return $this->successResponse(__('Your forum post successful'));
        } catch (\Exception $exception) {
            return $this->unprocessableResponse($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $forum = Forum::with(['user:id,name,photo'])->findOrFail($id);

        $comments = ForumComment::with([
            'user:id,name,photo', 
            'replies:id,forum_comment_id,reply,photo', 
            'replies.user:id,name,photo'
        ])->where('forum_id', $id)->get();

        $response = [
            'forum' => $forum, 
            'comments' => $comments
        ];
        
        return $this->successResponse($response);
    }
}
