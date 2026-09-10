<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Http\Requests\MovementsRequest;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameStatisticsResource;
use App\Http\Resources\MovementsResource;
use App\Models\Game;
use App\Models\Movements;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /*
     * to create a new game file
     */
    public function start(GameRequest $request)
    {
        $words = file('dictionary.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $words = collect($words);
        $word = $words->random();
        $player_two = $request->input('player_two', 'Computador');
        $game = Game::create([
            ...$request->validated(),
            'word' => $word,
            'player_two' => $player_two,
        ]);
        return new GameResource($game);
    }

    /*
     * every letter the users chooses
     */
    public function move(MovementsRequest $request, Game $game)
    {
        $count = $this->number_present($game->word, $request->input('letter'));
        $move = Movements::create([
            'game_id' => $game->id,
            ...$request->validated(),
            'number_present' => $count,
        ]);
        return new MovementsResource($move);
    }

    /*
     * to end the game as it should
     */
    public function end(Game $game)
    {
        if ($game->game_end !== null) {
            return new GameResource($game);
        }
        $game->game_end = now();
        $game->save();
        return new GameResource($game);
    }

    /*
     *
     * the api call when is the computer playing
     */
    public function computer(Game $game)
    {
//        forced wait when asking for the computer to move
        sleep(2);
        $alphabet = collect(str_split('abcdefghijklmnopqrstuvwxyz'));
        $vogals = collect(str_split('aeiou'));
        $consonants = $alphabet->diff($vogals->toArray());
        $vogalWasSelected = Movements::where('game_id', $game->id)->whereIn('letter', $vogals->toArray())->get();
        if ($vogalWasSelected->count() >= 5) {
//        if every vogal was selected, selected a random consonant
            $randomLetter = $consonants->random();
        } else {
            $missing = $vogals->diff($vogalWasSelected->pluck('letter')->toArray());
            $randomLetter = $missing->random();
        }
        $count = $this->number_present($game->word, $randomLetter);
        $movement = Movements::create([
            'player_responsible' => 'Computador',
            'letter' => $randomLetter,
            'number_present' => $count,
            'game_id' => $game->id,
        ]);
        return new MovementsResource($movement);
    }

    function number_present($gameWord, $checkedLetter)
    {
        $letters = str_split($gameWord);
        $count = 0;
        foreach ($letters as $letter) {
            if ($letter === $checkedLetter) {
                $count++;
            }
        }
        return $count;
    }

    public function statistics()
    {
        $games = Game::with('movements')->get();
        $computerCount = Game::where('mode', 'Computador')->count();
        $playerCount = Game::where('mode', 'One by One')->count();
        $incomplete = Game::whereNull('game_end')->count();
        $movements_total = Movements::count();
        return [
            'games_count' => $games->count(),
            'computer_percentage' => number_format($computerCount * 100 / $games->count(), 2) . '%',
            'player_percentage' => number_format($playerCount * 100 / $games->count(), 2) . '%',
            'incomplete' => number_format($incomplete * 100 / $games->count(), 2) . '%',
            'movements_total' => $movements_total,
            'movements_avg' => number_format($movements_total / $games->count(), 2) . '%',
        ];
    }
}
