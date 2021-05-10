<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Itinerary;
use Auth;

class ReviewController extends Controller
{

    /**
     * Retrieve all review by specified id
     *
     * @param number $itineraryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($itineraryId)
    {
        $data = Itinerary::find($itineraryId)->reviews;
        return ReviewResource::collection($data);
    }


    /**
     * Store the given data to database
     *
     * @param App\Http\Requests\Api\ReviewRequest $request
     * @param number $itineraryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReviewRequest $request, $itineraryId)
    {
        $data = $request->all();
        $data['customer_id'] = Auth::user()->id;
        $reviews = Itinerary::find($itineraryId)->reviews();

        if ($reviews->where('customer_id', $data['customer_id'])->exists()) {
            return response()->json([
                'message' => 'You already sent review'
            ], 402);
        }

        $reviews->create($data);

        return response()->json(['success' => true], 200);
    }
}
