<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItineraryResource;
use App\Itinerary;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Itinerary $itinerary)
    {
        $this->itinerary = $itinerary;
    }
    /**
     * Send all itinerary data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search')) ?: "";
        $offset = trim($request->get('offset')) ?: 0;
        $limit = trim($request->get('limit')) ?: 12;
        $orderBy = trim($request->get('order_by')) ?: "created_at";
        $order = trim($request->get('order')) ?: "desc";

        $data = $this->itinerary
            ->isPublished()
            ->withCount('orders')
            ->where('place_name', 'like', "%{$search}%")
            ->orderBy($orderBy, $order)
            ->offset($offset)
            ->limit($limit)
            ->get();

        return ItineraryResource::collection($data);
    }

    /**
     * Send a specified itinerary data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->itinerary->isPublished()->find($id);

        if (!$data) {
            return false;
        }

        $data->increment('view', 1);

        return new ItineraryResource($data);
    }
}
