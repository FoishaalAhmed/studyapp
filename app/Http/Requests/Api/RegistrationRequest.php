<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rules\Password;

class RegistrationRequest extends CustomFormRequest
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
            'age'          => ['nullable', 'numeric'],
            'name'         => ['required', 'string', 'max:255'],
            'gender'       => ['nullable', 'string', 'max:10'],
            'password'     => ['required', 'confirmed', Password::defaults()],
            'phone'        => ['required', 'string', 'max:15', 'unique:users'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ];
    }
}
