<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MakeOrderRequest;
use App\Order;
use Auth;

class OrderController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get all the customer orders
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(auth()->user()->order);
    }

    /**
     * Make a new order by given data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MakeOrderRequest $request)
    {
        $data = $request->all();

        return $this->order->insert([
            'customer_id' => Auth::user()->id,
            'itinerary_id' => $data['itinerary_id'],
            'code' => uniqid(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
