<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return $this->itinerary
                    ->isPublished()
                    ->with(['categories', 'districts'])
                    ->get();
    }

    /**
     * Send a specified itinerary data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $this->data = $this->itinerary
                           ->isPublished()
                           ->with(['categories', 'districts'])
                           ->find($id);

        if (!$this->data) {
            return false;
        }

        $this->data->increment('view', 1);
        return $this->data;
    }
}
