<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromocodeUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => ['required'],
            'discount' => ['required', 'numeric', 'min: 0.1'],
            'max_uses' => ['required', 'integer', 'min:1'],
            'expires_at' => ['required', 'date', 'after:today'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
