<?php

namespace App\Http\Resources;

use App\Models\Movements;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Movements */
class MovementsResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'player_responsible' => $this->player_responsible,
            'letter' => $this->letter,
            'number_present' => $this->number_present,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'game_id' => $this->game_id,

            'success' => $this->number_present > 0,

            'game' => new GameResource($this->whenLoaded('game')),
        ];
    }
}
