<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Psy\Util\Str;

class PublicController extends Controller
{
    public function login()
    {
        if (!auth()->guest()) {
            return redirect()->route('order.index');
        }
        return view('login');
    }

    public function logon(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        $user = Restaurant::where('login', $request->username)->first();
        if (!$user || $user->password_hash !== md5($request->password)) {
            session()->flash('login-error');
            return back();
        }
        auth()->login($user);
        return redirect()->route('order.index');
    }

    public function register()
    {
        return view('register');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function signup(RestaurantRequest $request)
    {
        $file = $request->file('photo');
        $url = \Illuminate\Support\Str::remove('img/', $file->move('img', $request->input('login') . '.' . $file->extension()));
        $created = Restaurant::create([
            ...$request->validated(),
            'category_id' => 1,
            'password_hash' => md5($request->input('password')),
            'photo' => $url,
        ]);
        return redirect()->route('login');
    }
}
