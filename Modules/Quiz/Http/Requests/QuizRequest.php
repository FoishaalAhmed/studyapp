<?php

namespace Modules\Quiz\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enums\{Status, ContentType};
use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id' => ['required', 'numeric', Rule::exists('categories', 'id')],
            'type'        => ['required', 'string', Rule::in([ContentType::FREE, ContentType::PREMIUM])],
            'title'       => ['required', 'string'],
            'price'       => request()->type == 'Premium' ? ['required', 'numeric'] : ['nullable'],
            'description' => ['nullable', 'string'],
        ];

        if ($this->getMethod() == 'POST') {

            return $rules + [
                'photo'  => ['required', 'mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024],
            ];
        } else {

            return $rules + [
                'photo'  => ['nullable', 'mimes:' . implode(',', getFileExtensions(3)), 'max:' . settings('max_file_size') * 1024],
                'status'      => ['required', 'string', Rule::in([Status::PUBLISHED, Status::IN_REVIEW])],
            ];
        }
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
