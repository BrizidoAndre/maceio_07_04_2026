<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NodeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'next_node' => ['nullable', 'integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
