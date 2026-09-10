<?php

namespace App\Http\Resources;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Game */
class GameResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'mode' => $this->mode,
            'player_one' => $this->player_one,
            'player_two' => $this->mode === 'Computador' ? 'Computador' : $this->player_two,
            'word' => $this->word,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
