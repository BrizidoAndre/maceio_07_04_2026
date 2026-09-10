<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Order extends Model
{
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'user_id',
        'restaurant_id',
        'order_date',
        'total_amount',
        'status',
        'promocode_id',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'restaurant_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    protected function casts()
    {
        return [
            'order_date' => 'datetime',
        ];
    }

    public function scopeStatus(EloquentBuilder $query, $status)
    {
        $query->with(['users', 'restaurant', 'orderItems.product'])->where('status', $status);
    }
}
