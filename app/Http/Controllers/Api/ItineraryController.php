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
    public function index()
    {
        $this->data = $this->itinerary->isPublished()->latest()->get();

        return ItineraryResource::collection($this->data);
    }

    /**
     * Send a specified itinerary data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $this->data = $this->itinerary->isPublished()->find($id);

        if (!$this->data) {
            return false;
        }

        $this->data->increment('view', 1);

        return new ItineraryResource($this->data);
    }
}
