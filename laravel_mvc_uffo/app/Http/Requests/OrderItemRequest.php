<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'order_item_id' => ['required', 'integer'],
            'order_id' => ['required', 'exists:orders'],
            'product_id' => ['required', 'exists:products'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'decimal:2'],
            'subtotal' => ['required', 'decimal:2'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
