<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'type' => ['required', 'numeric', 'min: 1'],
            'name' => ['required', 'string', 'max: 255'],
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'photo' => ['required', 'mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024],
            ];
        } else {
            return $rules + [
                'photo' => ['nullable', 'mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024],
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
