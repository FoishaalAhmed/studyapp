<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class ChildCategoryRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', Rule::in(['MCQ', 'Ebook', 'Sheet'])],
            'sub_category_id' => ['required', 'numeric', 'min:1'],
        ];
    }
}
