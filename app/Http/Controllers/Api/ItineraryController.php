<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItineraryResource;
use App\Itinerary;

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
    public function index($offset = 0, $limit = 12)
    {
        $data = $this->itinerary
            ->isPublished()
            ->latest()
            ->offset($offset)
            ->limit($limit)
            ->get();

        return ItineraryResource::collection($data);
    }

    /**
     * Find a specified resource
     *
     * @param string $search
     * @return JsonResponse
     */
    public function search($search)
    {
        //
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
