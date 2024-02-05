<?php

namespace Modules\Exam\Http\Requests\Api;

use App\Http\Requests\Api\CustomFormRequest;

class ExamQuestionAnswerRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'exam_id' => ['required', 'numeric'],
            'exam_question_id.*' => ['required', 'numeric'],
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
