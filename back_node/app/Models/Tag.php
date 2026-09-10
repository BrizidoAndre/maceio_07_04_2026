<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title',
    ];

//    get related responses
    public function responses()
    {
        return $this->hasMany(Response::class, 'tag_id');
    }

    public function dialogs()
    {
        return $this->hasMany(Dialog::class, 'tag_id');
    }
}
