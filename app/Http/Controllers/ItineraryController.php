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
        $this->data['categories'] = $this->category->get();

        return view('itinerary.index', $this->data);
    }

    /**
     * Display a create itinerary form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $this->data['categories'] = $this->category->get();

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
            // Retrieve category by slug or create it and return the id
            $category = $this->category->where('slug', $c)->first();

            if ( empty($category->id) ) {
                $category = $this->category->updateOrCreate([
                    'name' => $c,
                    'slug' => Str::slug($c, '-')
                ]);
            }

            return $category->id;
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
        $this->data['itinerary'] = $this->itinerary->find($id);
        $this->data['categories'] = $this->category->get();

        return view('itinerary.edit', $this->data);
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

        // store the request categories then take the id
        $categoryId = collect($request->categories)->map(function ($c) {
            // Retrieve category by slug or create it and return the id
            $category = $this->category->where('slug', $c)->first();

            if ( empty($category->id) ) {
                $category = $this->category->updateOrCreate([
                    'name' => $c,
                    'slug' => Str::slug($c, '-')
                ]);
            }

            return $category->id;
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
