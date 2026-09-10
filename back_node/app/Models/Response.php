<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'tag_id',
        'node_id',
        'next_node_id',
        'code_object',
        'code_inventory',
        'answer'
    ];

//    get existing tag
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    /*
     * get existing valid node
     */
    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    /*
     * get the next node to continue the conversation
     */
    public function nextNode()
    {
        return $this->belongsTo(Node::class, 'next_node_id');
    }
}
