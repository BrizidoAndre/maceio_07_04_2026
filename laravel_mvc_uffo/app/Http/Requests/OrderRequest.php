<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'order_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'restaurant_id' => ['required', 'exists:restaurants'],
            'order_date' => ['nullable', 'date'],
            'total_amount' => ['required', 'decimal:2'],
            'status' => ['required'],
            'promocode_id' => ['nullable', 'exists:promocodes'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
