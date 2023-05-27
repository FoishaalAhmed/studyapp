<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'    => 'required|string|max:255',
            'age'     => ['required', 'numeric'],
            'address' => 'nullable|string',
            'gender'  => ['required', 'string', Rule::in(['Male', 'Female'])],
            'email'   => 'required|email|max:255|unique:users,email,' . auth()->user()->id,
            'phone'   => 'required|string|max:15|unique:users,phone,' . auth()->user()->id,
        ];
    }
}
