<?php

namespace Modules\Ebook\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EbookRequest extends FormRequest
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
            'title' => ['required', 'string', 'max: 255'],
            'price' => ['required_if:type,Premium'],
            'type' => ['required', 'string', 'in:Premium,Free'],
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'book' => ['mimes:' . implode(',', getFileExtensions(0)), 'max:' . settings('max_file_size') * 1024, 'required'],
                'thumb' => ['mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024, 'required'],
            ];
        } else {
            return $rules + [
                'book' => ['mimes:' . implode(',', getFileExtensions(0)), 'max:' . settings('max_file_size') * 1024, 'nullable'],
                'thumb' => ['mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024, 'nullable'],
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
