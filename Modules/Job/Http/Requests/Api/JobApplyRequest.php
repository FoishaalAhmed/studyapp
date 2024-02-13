<?php

namespace Modules\Job\Http\Requests\Api;

use App\Http\Requests\Api\CustomFormRequest;

class JobApplyRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'job_id' => ['required', 'numeric'],
            'title' => ['required', 'array'],
            'document' => ['required', 'array']
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
