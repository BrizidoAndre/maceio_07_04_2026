<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        if (!auth()->guest()) {
            return redirect()->route('products.index');
        }
        return view('public.index');
    }

    public function logon(Request $request)
    {
        $request->validate([
            'username' => ['required',],
            'password' => ['required',],
        ]);

        $user = Restaurant::where('login', $request->username)->first();
        if (!$user || $user->password_hash !== md5($request->input('password'))) {
            session()->flash('login', 'Invalid credentials');
            return redirect()->route('login');
        }
        auth()->login($user);
        return redirect()->route('products.index');
    }
}
