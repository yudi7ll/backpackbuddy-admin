<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItineraryRequest;
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
        $this->middleware('auth');
        $this->itinerary = $itinerary;
    }

    /**
     * Display a listing of all premium itinerary
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('itinerary.index', [ 'itineraries' => $this->itinerary->all() ]);
    }

    /**
     * Display a create itinerary form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('itinerary.create');
    }

    /**
     * Store new data to database
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(ItineraryRequest $request)
    {
        $this->itinerary->create($request->all());

        return redirect()->back();
    }
}
