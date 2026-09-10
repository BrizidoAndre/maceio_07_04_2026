<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'restaurant_id',
        'name',
        'description',
        'price',
        'photo',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
