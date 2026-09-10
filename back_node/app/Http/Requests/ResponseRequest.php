<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResponseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'tag_id' => ['required', 'exists:tags'],
            'node_id' => ['required', 'exists:nodes'],
            'next_node_id' => ['nullable', 'exists:nodes'],
            'code_object' => ['nullable'],
            'code_inventory' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
