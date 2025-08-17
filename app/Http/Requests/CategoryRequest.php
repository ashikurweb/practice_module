<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'slug'          => 'nullable|string|unique:categories,slug,' . $this->category, 
            'status'        => 'required|in:active,inactive',
            'short_content' => 'nullable|string|max:500',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'   => 'The category name is required.',
            'slug.required'   => 'The slug is required.',
            'slug.unique'     => 'The slug must be unique.',
            'status.required' => 'The status is required.',
            'status.in'       => 'The status must be active or inactive.',
            'image.image'     => 'The image must be a valid image file.',
        ];
    }
}
