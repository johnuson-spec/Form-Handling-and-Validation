<?php

namespace App\Http\Requests;

use App\Rules\IsbnChecksum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'isbn' => str_replace('-', '', $this->isbn ?? ''),
            'is_reference' => $this->boolean('is_reference'),
        ]);
    }

    public function rules(): array
    {
        return [
            'isbn' => ['required', 'string', 'size:13', new IsbnChecksum(), Rule::unique('books', 'isbn')],
            'title' => ['required', 'string', 'max:255'],
            'author_id' => ['required', Rule::exists('authors', 'id')],
            'published_year' => ['required', 'integer', 'between:1450,' . date('Y')],
            'is_reference' => ['boolean'],
            'cover' => ['nullable', 'image', 'mimes:jpg,png', 'max:1024'],
        ];
    }
}