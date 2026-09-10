<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function promocode()
    {
        return $this->belongsTo(Promocode::class, 'promocode_id', 'promocode_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    protected function casts()
    {
        return [
            'order_date' => 'timestamp',
        ];
    }


    public function scopeStatus(Builder $query, $status, $date = 'now')
    {
        $query->with(['orderItems.product', 'user', 'promocode', 'restaurant']);
        if ($date === 'now') {
            $query->whereToday('order_date');
        }
        $query->where('restaurant_id', auth()->id());
        $query->where('status', $status);
    }
}
