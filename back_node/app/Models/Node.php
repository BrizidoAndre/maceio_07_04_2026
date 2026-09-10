<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = [
        'next_node',
    ];

    /*
     *  get related responses models
     */
    public function responses()
    {
        return $this->hasMany(Response::class, 'node_id');
    }

    /*
     * get current related diagogs (can be more than once)
     */
    public function dialogs()
    {
        return $this->hasMany(Dialog::class, 'node_id');
    }

    /*
     * get current related dialog on top of the relation
     */
    public function dialog()
    {
        return $this->hasOne(Dialog::class, 'node_id');
    }
}
