<?php

namespace Modules\Page\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [

            'photo'  => ['nullable', 'mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024],
            'content' => ['required', 'string'],
            'title' => ['nullable', 'string', 'max:255'],
        ];

        if ($this->getMethod() == 'POST') {

            return $rules + [
                'name'    => ['required', 'string', 'max:255', 'unique:pages,name']
            ];

        } else {

            return $rules + [
                'name'    => ['required', 'string', 'max:255', 'unique:pages,name,' . $this->page->id]
            ];
        }
    }
}
