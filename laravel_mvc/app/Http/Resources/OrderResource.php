<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'order_id' => $this->order_id,
            'order_date' => $this->order_date,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'promocode_id' => $this->promocode_id,

            'user_id' => $this->user_id,
            'restaurant_id' => $this->restaurant_id,

            'restaurant' => new RestaurantResource($this->whenLoaded('restaurant')),
        ];
    }
}
