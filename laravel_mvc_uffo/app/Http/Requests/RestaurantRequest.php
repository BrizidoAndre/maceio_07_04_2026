<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'login' => ['required', 'unique:restaurants,login'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
