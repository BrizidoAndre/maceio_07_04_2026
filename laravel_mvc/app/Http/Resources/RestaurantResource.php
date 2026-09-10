<?php

namespace App\Http\Resources;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Restaurant */
class RestaurantResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'restaurant_id' => $this->restaurant_id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'category_id' => $this->category_id,
            'login' => $this->login,
            'password_hash' => $this->password_hash,
            'photo' => $this->photo,
        ];
    }
}
