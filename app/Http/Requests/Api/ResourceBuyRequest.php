<?php

namespace App\Http\Requests\Api;

class ResourceBuyRequest extends CustomFormRequest
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
            'price' => ['required', 'numeric'],
            'resource_id' => ['required', 'numeric'],
            'type' => ['required', 'string', 'max:100'],
            'payment_method' => ['nullable', 'string', 'max:100'],
        ];
    }
}
