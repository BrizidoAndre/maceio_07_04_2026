<?php

namespace App\Http\Resources;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Review */
class ReviewResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'review_id' => $this->review_id,
            'restaurant_id' => $this->restaurant_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'date_created' => $this->date_created,

            'user_id' => $this->user_id,
        ];
    }
}
