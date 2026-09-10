<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movements extends Model
{
    protected $fillable = [
        'game_id',
        'player_responsible',
        'letter',
        'number_present',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
