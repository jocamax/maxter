<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'           => ['required','string','max:255'],
            'price'           => ['required','numeric','min:0'],
            'description'     => ['required','string'],
            'technical_data'  => ['required','string'],
            'images'          => ['nullable','array','min:0','max:5'],
            'images.*'        => ['image','mimes:jpg,jpeg,png,webp','max:4096'],
            'related'         => ['nullable','array','max:5'],
            'related.*'       => ['integer','exists:products,id','distinct'],
            'category' => ['nullable','string','max:100'],
        ];
    }
}
