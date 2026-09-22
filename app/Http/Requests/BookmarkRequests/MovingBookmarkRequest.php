<?php

namespace App\Http\Requests\BookmarkRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class MovingBookmarkRequest extends FormRequest
{
    protected $errorBag = 'movingBookmarkForm';

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'collection_id' => [
                'nullable',
                Rule::exists('collections', 'id')->where('user_id', $this->user()->id),
            ]
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'collection_id.exists' => 'La colección seleccionada no es válida.',
        ];
    }
}
