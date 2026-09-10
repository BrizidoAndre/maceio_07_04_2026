<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function status(Order $order, string $status)
    {
        $order->status = $status;
        $order->save();
        return redirect()->route('orders.index');
    }
}
