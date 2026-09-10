<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'product_id' => $this->product_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'photo' => $this->photo,

            'restaurant_id' => $this->restaurant_id,

            'restaurant' => new RestaurantResource($this->whenLoaded('restaurant')),
        ];
    }
}
