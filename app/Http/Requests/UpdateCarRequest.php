<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'brand'       => 'required|string|max:100',
            'model'       => 'required|string|max:100',
            'year'        => 'required|integer|min:1990|max:2005',
            'engine'      => 'nullable|string|max:100',
            'color'       => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
        ];
    }
}
