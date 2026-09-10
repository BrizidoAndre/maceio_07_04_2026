<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
