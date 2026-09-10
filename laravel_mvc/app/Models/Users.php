<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'username',
        'password_hash',
        'email',
        'phone_number',
        'token',
        'registration_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts()
    {
        return [
            'registration_date' => 'timestamp',
        ];
    }
}
