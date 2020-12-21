<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItineraryRequest;
use App\Itinerary;

class ItineraryController extends Controller
{
    private $itinerary;

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
        $itineraries = $this->itinerary->all();

        return view('itinerary.index', compact('itineraries'));
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

    /**
     * Update a specified data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(ItineraryRequest $request, $id)
    {
        $this->itinerary->find($id)->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove a specified data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($id)
    {
        $this->itinerary->destroy($id);

        return redirect()->back();
    }
}
