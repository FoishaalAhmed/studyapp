<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name'              => 'required|string|max: 255',
            'photo'             => 'mimes: jpeg,jpg,png,gif,webp|max: 1000|nullable',
            'role_id'           => 'required|numeric',
            'present_address'   => 'nullable|string',
            'permanent_address' => 'nullable|string',
        ];

        if ($this->getMethod() == 'POST') {
            return $rules + [
                'password' => 'required|string|min:8|confirmed',
                'email'    => 'required|email|max:255|unique:users,email',
                'phone'    => 'required|string|max:15|unique:users,phone',
            ];
        } else {
            return $rules + [
                'email' => 'required|email|max:255|unique:users,email,' . $this->admin->id,
                'phone' => 'required|string|max:15|unique:users,phone,' . $this->admin->id,
            ];
        }
    }
}
