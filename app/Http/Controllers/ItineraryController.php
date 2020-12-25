<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ItineraryRequest;
use App\Itinerary;
use Str;

class ItineraryController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Itinerary $itinerary, Category $category)
    {
        $this->middleware('auth');
        $this->itinerary = $itinerary;
        $this->category = $category;
    }

    /**
     * Display a listing of all premium itinerary
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['itineraries'] = $this->itinerary->get();

        return view('itinerary.index', $this->data);
    }

    /**
     * Display a create itinerary form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $this->data['categories'] = $this->category->isPublished()->get();

        return view('itinerary.create', $this->data);
    }

    /**
     * Store new data to database
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(ItineraryRequest $request)
    {
        // get all request except categories
        $requestData = $request->except('categories');

        // store the data to database
        $newItinerary = $this->itinerary->create($requestData);

        // store the request categories then take the id
        $categoryId = collect($request->categories)->map(function ($c) {
            return $this->category->firstOrCreate([
                'name' => $c,
                'slug' => Str::slug($c, '-'),
            ])->id;
        });

        $newItinerary->categories()->sync($categoryId);

        return redirect()->back()->with('message', 'Data added successfully!');
    }

    /**
     * Show an edit form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $itinerary = $this->itinerary->find($id);

        return view('itinerary.edit', compact('itinerary'));
    }

    /**
     * Update a specified data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(ItineraryRequest $request, $id)
    {
        $this->data = $this->itinerary->find($id);

        // update itinerary
        $this->data->update($request->except('categories'));

        // update the request categories then take the id
        $categoryId = collect($request->categories)->map(function ($c) {
            return $this->category->firstOrCreate([
                'name' => $c,
                'slug' => Str::slug($c, '-'),
            ])->id;
        });

        $this->data->categories()->sync($categoryId);


        return redirect()->back()->with('message', 'Data updated successfully!');
    }

    /**
     * Remove a specified data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($id)
    {
        $this->itinerary->destroy($id);

        return redirect()->back()->with('message', 'Data deleted successfully!');
    }
}
