<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class ProfileRequest extends CustomFormRequest
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
            'name'    => 'required|string|max:255',
            'age'     => ['required', 'numeric'],
            'address' => 'nullable|string',
            'gender'  => ['required', 'string', Rule::in(['Male', 'Female'])],
            'email'   => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'phone'   => ['required', 'string', 'max:15', 'unique:users,phone,' . auth()->id()]
        ];
    }
}
