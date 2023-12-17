<?php

namespace Modules\Mcq\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = ['model_test_id' => ['required', 'numeric', 'min:1']];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'question.*' => ['required'],
                'answer.*' => ['required'],
                'answer1.*' => ['required'],
                'answer2.*' => ['required'],
                'answer3.*' => ['required'],
                'answer4.*' => ['required'],
            ];
        } else {
            return $rules + [
                'question' => ['required', 'string', 'max:255'],
                'answer' => ['required', 'string', 'max:255'],
                'answer1' => ['required', 'string', 'max:255'],
                'answer2' => ['required', 'string', 'max:255'],
                'answer3' => ['required', 'string', 'max:255'],
                'answer4' => ['required', 'string', 'max:255'],
                'explanation' => ['nullable', 'string'],
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
