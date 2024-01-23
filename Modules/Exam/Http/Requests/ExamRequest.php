<?php

namespace Modules\Exam\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id' => ['required', 'numeric', 'min:1'],
            'subject_id' => ['nullable', 'numeric'],
            'exam_type' => ['required', 'string', 'max:20'],
            'type' => ['required', 'string', 'in:Free,Premium'],
            'chapter' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'mark_per_question' => ['required', 'numeric'],
            'negative_mark' => ['required', 'numeric'],
            'time' => ['required', 'numeric'],
            'price' => ['required_if:type,1'],
            'start_date' => ['required'],
            'start_time' => ['required'],
            'result_date' => ['required'],
            'result_time' => ['required'],
            'note' => ['required_if:exam_type,==,1'],
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'photo' => ['mimes:' . implode(',', getFileExtensions(3)), 'max: 5000', 'required'],
            ];
        } else {
            return $rules + [
                'photo' => ['mimes:' . implode(',', getFileExtensions(3)), 'max: 5000', 'nullable'],
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
