<?php

namespace Modules\LectureSheet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureSheetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'child_category_id' => ['required', 'numeric', 'min:1'],
            'subject_id' => ['nullable', 'numeric', 'min:1'],
            'chapter' => ['required', 'string', 'max: 255'],
            'type' => ['required', 'string', 'in:Premium,Free'],
            'price' => ['required_if:type,Premium'],
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'thumb' => ['required', 'mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024],
                'file' => ['mimes:' . implode(',', getFileExtensions(0)), 'max: 5000', 'required'],
            ];
        } else {
            return $rules + [
                'thumb' => ['nullable', 'mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024],
                'file' => ['mimes:' . implode(',', getFileExtensions(0)), 'max: 5000', 'nullable'],
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
