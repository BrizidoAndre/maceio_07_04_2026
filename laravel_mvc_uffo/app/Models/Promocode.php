<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $primaryKey = 'promocode_id';
    public $timestamps = false;

    protected $fillable = [
        'promocode_id',
        'restaurant_id',
        'code',
        'discount',
        'max_uses',
        'current_uses',
        'expires_at',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    protected function casts()
    {
        return [
            'expires_at' => 'datetime',
        ];
    }
}
