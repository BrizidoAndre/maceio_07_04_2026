<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
{
    public function rules()
    {
        return [
            'restaurant_id' => ['required', 'integer'],
            'name' => ['required'],
            'description' => ['nullable'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'category_id' => ['required', 'integer'],
            'login' => ['required'],
            'password_hash' => ['required'],
            'photo' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
