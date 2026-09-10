<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';
    public $timestamps = false;

    protected $fillable = [
        'review_id',
        'user_id',
        'restaurant_id',
        'rating',
        'comment',
        'date_created',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id','user_id');
    }

    protected function casts()
    {
        return [
            'date_created' => 'timestamp',
        ];
    }
}
