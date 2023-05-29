<?php

namespace Modules\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'large_logo' => ['nullable', 'mimes:'. implode(',' ,getFileExtensions(3)), 'max:'. settings('max_file_size') * 1024],
            'small_logo' => ['nullable', 'mimes:'. implode(',' ,getFileExtensions(3)), 'max:'. settings('max_file_size') * 1024],
            'favicon' => ['nullable', 'mimes:'. implode(',' ,getFileExtensions(3)), 'max:'. settings('max_file_size') * 1024],
            'row_per_page' => ['required', 'numeric', 'min:10', 'max:100'],
            'max_file_size' => ['required', 'numeric', 'min:1', 'max:20']
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
