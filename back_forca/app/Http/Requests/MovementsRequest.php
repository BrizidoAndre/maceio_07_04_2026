<?php

namespace App\Http\Requests;

use App\Models\Game;
use App\Models\Movements;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class MovementsRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function rules()
    {
        $game = request('game', new Game());
        return [
            'player_responsible' => ['required'],
            'letter' => ['required', 'string', 'max:1', function ($attribute, $value, $fail) use ($game) {
                $letterSelected = Movements::where('game_id', $game->getKey())->pluck('letter');
                if ($letterSelected->contains($value)) {
                    $fail('This is an already selected letter');
                }
            }],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
