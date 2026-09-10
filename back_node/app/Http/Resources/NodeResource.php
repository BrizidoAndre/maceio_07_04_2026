<?php

namespace App\Http\Resources;

use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Node */
class NodeResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'next_node' => $this->next_node,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
