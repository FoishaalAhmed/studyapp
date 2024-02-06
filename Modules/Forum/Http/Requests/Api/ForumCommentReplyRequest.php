<?php

namespace Modules\Forum\Http\Requests\Api;

use App\Http\Requests\Api\CustomFormRequest;

class ForumCommentReplyRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reply' => ['required', 'string'],
            'forum_comment_id' => ['required', 'numeric'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
