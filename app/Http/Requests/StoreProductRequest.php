<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // <<--- MUST be true or Laravel will return 403
    }

    public function rules()
    {
        return [
            'name'     => 'required|string|min:1', // filled & min 1 enforces non-empty
            'price'    => 'required|numeric|min:0',
            'category' => 'required|string|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 1 character.',
        ];
    }
}
