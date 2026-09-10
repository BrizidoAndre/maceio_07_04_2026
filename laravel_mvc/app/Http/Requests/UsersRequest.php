<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'username' => ['required'],
            'password_hash' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'phone_number' => ['nullable'],
            'token' => ['nullable'],
            'registration_date' => ['nullable', 'date'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
