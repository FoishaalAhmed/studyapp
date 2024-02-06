<?php

namespace Modules\Forum\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Forum\Entities\ForumCommentReply;
use Modules\Forum\Http\Requests\Api\ForumCommentReplyRequest;

class ForumCommentReplyController extends Controller
{
    public function store(ForumCommentReplyRequest $request)
    {
        try {
            (new ForumCommentReply())->storeReply($request);
            return $this->successResponse(__('Reply successful'));
        } catch (\Exception $exception) {
            return $this->unprocessableResponse($exception->getMessage());
        }
    }
}
