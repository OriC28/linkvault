<?php

namespace App\Http\Requests\CollectionRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreCollectionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:4|max:100|unique:collections,name',
            'description' => 'nullable|string|max:255',
            'is_public' => 'boolean',
        ];
    }
    /**
     * Custom error messages for each validation rules.
     *
     * @return array
     */
    #[Override]
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la colección es requerido.',
            'name.unique' => 'El nombre de la colección ya está ocupado. Intente con uno nuevo.',
            'name.min' => 'El nombre de la colección debe tener al menos 4 caracteres.',
            'name.max' => 'El nombre de la colección debe tener máximo 100 caracteres.',
            'description' => 'La descripción de la colección debe tener máximo 255 caracteres.',
        ];
    }
}
