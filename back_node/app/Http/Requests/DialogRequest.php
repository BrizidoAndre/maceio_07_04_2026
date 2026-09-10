<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DialogRequest extends FormRequest
{
    public function rules()
    {
        $id = request('dialog', false);
        return [
            // if it is an update it does not need to be unique
            'id' => ['required', Rule::unique('dialogs', 'id')->ignore($id)],
            'tag_id' => ['required', 'exists:tags,id'],
            'notes' => ['required'],
            'protagonist_name' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
