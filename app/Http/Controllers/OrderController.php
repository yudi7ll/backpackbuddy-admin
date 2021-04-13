<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\Services\OrderService;

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
    public function index($filter = null)
    {
        $status = (int) OrderService::toStatusCode($filter);
        $orders = $this->order;

        if ($status) {
            $orders = $orders->where('status', $status);
        }

        $orders = $orders->get();
        $filter = OrderService::toStatusName($status) ?: 'All Orders';

        return view('pages.order.index', compact('orders', 'filter'));
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

    /**
     * Update the specified resource
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(OrderRequest $request, Order $order)
    {
        $this->data = $request->all();

        // If the status is completed add timestamp
        if ($this->data['status'] == 2) {
            $order->completed_at = now();
        }

        $order->status = $this->data['status'];
        $order->save();

        return redirect()->back()->with('success', 'Data updated successfully');
    }
}
