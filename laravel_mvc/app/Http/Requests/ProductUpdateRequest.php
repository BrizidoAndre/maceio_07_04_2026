<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['nullable'],
            'description' => ['nullable'],
            'price' => ['nullable', 'numeric', 'min:0.1'],
            'photo' => ['file', 'image', 'mimes:jpeg,png,jpg',],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
