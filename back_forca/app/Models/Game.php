<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'mode',
        'player_one',
        'player_two',
        'word',
    ];

    public function movements()
    {
        return $this->hasMany(Movements::class, 'game_id');
    }
}
