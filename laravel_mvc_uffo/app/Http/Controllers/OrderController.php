<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('dash');
    }

    public function status(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();
        return redirect()->route('order.index');
    }

    public function statusLink(Order $order, $status)
    {
        $order->status = $status;
        $order->save();
        return redirect()->route('order.index');
    }
}
