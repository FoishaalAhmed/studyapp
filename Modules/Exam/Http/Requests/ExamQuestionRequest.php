<?php

namespace Modules\Exam\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
        $rules = [
            'exam_id' => ['required', 'numeric', 'min:1']
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'question.*' => ['required'],
                'answer1.*' => ['required'],
                'answer2.*' => ['required'],
                'answer3.*' => ['required'],
                'answer4.*' => ['required'],
                'correct_answer.*' => ['required'],
            ];
        } else {
            return $rules + [
                'question' => ['required', 'string'],
                'answer1' => ['required', 'string'],
                'answer2' => ['required', 'string'],
                'answer3' => ['required', 'string'],
                'answer4' => ['required', 'string'],
                'correct_answer' => ['required', 'string']
            ];
        }
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
