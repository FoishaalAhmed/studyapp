<?php

namespace Modules\Subject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [

            'photo'  => ['nullable', 'mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024],
            'category_ids' => ['required', 'array', 'min:1'],
        ];

        if ($this->getMethod() == 'POST') {

            return $rules + [
                'name'    => ['required', 'string', 'max:255', 'unique:subjects,name']
            ];
        } else {

            return $rules + [
                'name'    => ['required', 'string', 'max:255', 'unique:subjects,name,' . $this->subject->id]
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
