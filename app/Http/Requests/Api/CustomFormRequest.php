<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomFormRequest extends FormRequest
{
    use ApiResponse;

    /**
     * To handle validation error for api and formatting the error response
     *
     * @param Validator $validator
     * @throws HttpResponseException
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        if ($this->wantsJson()) {
            throw new HttpResponseException($this->unprocessableResponse($validator->errors()));
        }

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}