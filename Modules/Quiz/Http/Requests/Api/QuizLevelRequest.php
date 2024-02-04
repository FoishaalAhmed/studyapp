<?php

namespace Modules\Quiz\Http\Requests\Api;

use Illuminate\Validation\Rule;
use App\Http\Requests\Api\CustomFormRequest;

class QuizLevelRequest extends CustomFormRequest
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
            'category' => ['required', 'numeric', Rule::exists('categories', 'id')],
            'level' => ['required', 'numeric', 'min:1']
        ];
    }
}
