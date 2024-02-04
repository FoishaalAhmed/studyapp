<?php

namespace Modules\Quiz\Http\Requests\Api;

use Illuminate\Validation\Rule;
use App\Http\Requests\Api\CustomFormRequest;

class QuizRequest extends CustomFormRequest
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
            'quiz' => ['required', 'numeric', Rule::exists('quizzes', 'id')],
            'level' => ['required', 'numeric', 'min:1']
        ];
    }
}
