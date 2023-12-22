<?php

namespace Modules\Job\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'job_category_id' => ['numeric', 'required', 'min:1'],
            'title' => ['string', 'required', 'max:255'],
            'company' => ['string', 'nullable', 'max:255'],
            'location' => ['string', 'nullable', 'max:255'],
            'end_date' => ['date', 'required', 'after:yesterday'],
            'description' => ['string', 'nullable'],
            'photo' => ['mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024, 'nullable'],
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
