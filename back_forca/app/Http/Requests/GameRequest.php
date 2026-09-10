<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GameRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function rules()
    {
        return [
            'mode' => ['required', Rule::in(['One by One', 'Computador'])],
            'player_one' => ['required'],
            'player_two' => ['required_if:mode,One by One'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
