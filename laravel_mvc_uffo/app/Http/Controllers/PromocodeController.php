<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromocodeRequest;
use App\Http\Requests\PromocodeUpdateRequest;
use App\Models\Product;
use App\Models\Promocode;

class PromocodeController extends Controller
{
    public function index()
    {
        return view('promocodes');
    }

    public function destroy(Promocode $promocode)
    {
        $promocode->delete();
        return redirect()->route('promocodes.index');
    }

    public function store(PromocodeRequest $request)
    {
        Promocode::create([
            ...$request->validated(),
            'restaurant_id' => auth()->id(),
            'current_uses' => 0,
        ]);
        return redirect()->route('promocodes.index');
    }

    public function update(PromocodeUpdateRequest $request, Promocode $promocode)
    {
        $promocode->update([
            ...$request->validated(),
        ]);
        return redirect()->route('promocodes.index');
    }


}
