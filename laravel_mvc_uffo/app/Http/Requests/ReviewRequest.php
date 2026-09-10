<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function rules()
    {
        return [
            'review_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'restaurant_id' => ['required', 'integer'],
            'rating' => ['required', 'integer'],
            'comment' => ['nullable'],
            'date_created' => ['nullable', 'date'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
