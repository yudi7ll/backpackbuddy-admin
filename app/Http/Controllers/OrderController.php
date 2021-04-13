<?php

namespace App\Http\Controllers;

use App\Order;

class OrderController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->middleware('auth');
        $this->order = $order;
    }

    /**
     * Display a listing of all orders
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = $this->order->all();
        return view('pages.order.index', compact('orders'));
    }

    /**
     * Display an Edit form of a specified order
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Order $order)
    {
        return view('pages.order.edit', compact('order'));
    }
}
