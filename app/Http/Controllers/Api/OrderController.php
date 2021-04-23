<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MakeOrderRequest;
use App\Itinerary;
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
        $data['code'] = uniqid();
        $data['price'] = Itinerary::find($request->itinerary_id)->price;

        if (Auth::user()->orders()->where('itinerary_id', $data['itinerary_id'])->exists()) {
            return response()->json(['message' => 'This itinerary already in orders'], 402);
        }

        return Auth::user()->orders()->create($data);
    }
}
