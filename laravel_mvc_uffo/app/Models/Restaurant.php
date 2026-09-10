<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{
    protected $primaryKey = 'restaurant_id';
    public $timestamps = false;

    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'address',
        'phone_number',
        'category_id',
        'login',
        'password_hash',
        'photo',
    ];
}
