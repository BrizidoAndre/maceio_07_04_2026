<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'node_id',
        'tag_id',
        'notes',
        'protagonist_name',
    ];

    /*
     * get current node mode
     */
    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    /*
     * get related tag of this dialog (it must have at least one)
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
