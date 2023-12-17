<?php

namespace Modules\Mcq\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelQuestionAnswerRequest extends FormRequest
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
