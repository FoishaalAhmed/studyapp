<?php

namespace Modules\Mcq\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelTestRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id' => ['required', 'numeric', 'min: 1'],
            'subject_id' => ['nullable', 'numeric', 'min: 1'],
            'title' => ['required', 'string', 'max: 255'],
            'year' => ['nullable', 'numeric',],
            'time' => ['required', 'numeric',],
            'type' => ['required', 'numeric', 'min:0', 'max:1'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'mimes:jpeg,jpg,png,gif,webp', 'max:1000'],
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
