<?php

namespace Modules\Testimonial\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['string', 'max: 255', 'required'],
            'position' => ['string', 'max: 255', 'required'],
            'message' => ['string', 'required', 'max: 250',],
            'star' => ['numeric', 'max: 5', 'min:1', 'required'],
            'photo'  => ['mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024, 'nullable'],
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
