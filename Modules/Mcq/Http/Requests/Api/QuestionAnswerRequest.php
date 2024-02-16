<?php

namespace Modules\Mcq\Http\Requests\Api;

use App\Http\Requests\Api\CustomFormRequest;

class QuestionAnswerRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'model_test_id' => ['required', 'numeric'],
            'question_id.*' => ['required', 'numeric'],
            'given_answer.*' => ['required', 'numeric'],
            'right_answer' => ['required', 'numeric'],
            'wrong_answer' => ['required', 'numeric'],
            'total_time' => ['required', 'integer'],
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
