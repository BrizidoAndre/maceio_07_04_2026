<?php

namespace App\Http\Resources;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Users */
class UsersResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'username' => $this->username,
            'password_hash' => $this->password_hash,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'token' => $this->token,
            'registration_date' => $this->registration_date,

            'user_id' => $this->user_id,
        ];
    }
}
