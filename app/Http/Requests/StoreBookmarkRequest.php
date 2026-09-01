<?php

namespace App\Http\Requests;

use App\Models\Tag;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Override;

class StoreBookmarkRequest extends FormRequest
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

        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('tags')) {

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
            'tags.required' => 'Debe seleccionar al menos una etiqueta.',
            'tags.collection' => 'El formato de las etiquetas no es válido',
        ];
    }
}
