<?php

namespace App\Http\Resources;

use App\Models\Dialog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Dialog */
class DialogResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'notes' => $this->notes,
            'protagonist_name' => $this->protagonist_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'node_id' => $this->node_id,
            'tag_id' => $this->tag_id,

            'node' => new NodeResource($this->whenLoaded('node')),
            'tag' => new TagResource($this->whenLoaded('tag')),
        ];
    }
}
