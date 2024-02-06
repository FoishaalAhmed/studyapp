<?php

namespace Modules\Forum\Http\Requests\Api;

use App\Http\Requests\Api\CustomFormRequest;

class ForumRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photo' => ['mimes:' . implode(',', getFileExtensions(3)), 'max: 1000', 'nullable']
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
