<?php

namespace App\Http\Resources;

use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Promocode */
class PromocodeResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'promocode_id' => $this->promocode_id,
            'code' => $this->code,
            'discount' => $this->discount,
            'max_uses' => $this->max_uses,
            'current_uses' => $this->current_uses,
            'expires_at' => $this->expires_at,

            'restaurant_id' => $this->restaurant_id,

            'restaurant' => new RestaurantResource($this->whenLoaded('restaurant')),
        ];
    }
}
