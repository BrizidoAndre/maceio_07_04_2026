<?php

namespace App\Http\Resources;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Response */
class ResponseResource extends JsonResource
{
    public function toArray(Request $request)
    {
        // get item query parameter, if is the same as the needed in this response,
        // then it is accessible
        $item = request()->query('item', false);
        $accessible = true;
        if ($this->code_inventory === 'give' && $this->code_object) {
            $accessible = false;
            if ($item) {
                $accessible = $item === $this->code_object;
            }
        }
        return [
            'id' => $this->id,
            'code_object' => $this->code_object,
            'code_inventory' => $this->code_inventory,
            'end' => (bool)$this->next_node_id,
            'text' => $this->answer,
            'accessible' => $accessible,
            'item' => $item,
            'next_node_id' => $this->next_node_id
        ];
    }
}
