<?php

namespace App\Http\Requests\BookmarkRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Override;

class UpdateBookmarkRequest extends FormRequest
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
            'url' => 'nullable|url|max:2048',
            'title' => 'nullable|string|max:100|min:3',
            'description' => 'nullable|string|max:255',
            'collection_id' => 'required|exists:collections,id',
            'tags' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!$value instanceof Collection) {
                        $fail("El campo $attribute debe ser una colección de tags válida.");
                    }
                }
            ],
            'is_favorite' => 'required|boolean'
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('tags') && !empty($this->input('tags'))) {

            $tags = $this->input('tags');

            $tagsCollection = $this->parseCollection($tags);

            $this->merge([
                'tags' => $tagsCollection
            ]);
        }
    }

    private function parseCollection(string $tags): Collection
    {
        return collect(json_decode($tags, true));
    }

    #[Override]
    public function messages(): array
    {
        return [
            'url.url' => 'La url no tiene un formato válido.',
            'url.max' => 'La url supera el máximo de 2048 caracteres.',

            'title.string' => 'El título no tiene un formato válido.',
            'title.max' => 'El título debe contener un máximo de 100 caracteres.',
            'title.min' => 'El título debe contener un mínimo de 3 caracteres.',

            'description.string' => 'La descripción no tiene un formato válido.',
            'description.max' => 'La descripción debe contener un máximo de 255 caracteres.',

            'collection_id.required' => 'La colección es obligatoria, en su defecto seleccione "Sin colección".',
            'collection_id.exists' => 'La colección seleccionada no es válida.',

            'tags.required' => 'Debe seleccionar al menos una etiqueta.',
            'tags.collection' => 'El formato de las etiquetas no es válido',

            'is_favorite' => 'El campo debe ser favorito o no favorito legítimamente.',
        ];
    }
}
