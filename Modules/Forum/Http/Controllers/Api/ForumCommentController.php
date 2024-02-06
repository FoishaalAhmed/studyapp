<?php

namespace Modules\Forum\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use Modules\Forum\Entities\ForumComment;
use Modules\Forum\Http\Requests\Api\{ForumCommentRequest, ForumCommentStoreRequest};

class ForumCommentController extends Controller
{
    public function store(ForumCommentStoreRequest $request)
    {
        try {
            (new ForumComment)->storeComment($request);
            return $this->successResponse(__('Comment Successful.'));
        } catch (Exception $exception) {
            return $this->unprocessableResponse($exception->getMessage());
        }
    }

    public function vote(ForumCommentRequest $request)
    {
        try {
            $forum = $this->findForumComment($request->forum_comment_id);
            $forum->vote = $forum->vote + 1;
            $forum->save();
            return $this->successResponse(__('Vote done successfully.'));
        } catch (Exception $exception) {
            return $this->unprocessableResponse($exception->getMessage());
        }
    }

    public function correct(ForumCommentRequest $request)
    {
        try {
            $forum = $this->findForumComment($request->forum_comment_id);
            $forum->correct_answer = 1;
            $forum->save();
            return $this->successResponse();
        } catch (Exception $exception) {
            return $this->unprocessableResponse($exception->getMessage());
        }
        
    }

    private function findForumComment($forumCommentId)
    {
        $forum = ForumComment::where('id', $forumCommentId)->first();

        if (is_null($forum)) {
            throw new Exception(__('Forum Comment does not exist.'));
        }

        return $forum;
    }
}
