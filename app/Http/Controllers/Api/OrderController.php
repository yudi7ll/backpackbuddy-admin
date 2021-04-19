<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
     * Store the given data to database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        //
    }
}
