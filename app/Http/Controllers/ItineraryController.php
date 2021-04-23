<?php

namespace App\Http\Controllers;

use App\Category;
use App\District;
use App\Http\Requests\ItineraryRequest;
use App\Http\Traits\MediaTrait;
use App\Itinerary;
use Session;
use Str;

class ItineraryController extends Controller
{
    use MediaTrait;

    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Itinerary $itinerary, Category $category, District $district)
    {
        $this->middleware('auth');
        $this->itinerary = $itinerary;
        $this->category = $category;
        $this->district = $district;
    }

    /**
     * Display a listing of all premium itinerary
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['itineraries'] = $this->itinerary
            ->with(['media', 'categories', 'districts'])->get();

        return view('pages.itinerary.index', $data);
    }

    /**
     * Display a create itinerary form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $data['categories'] = $this->category->all();
        $data['districts'] = $this->district->all();

        return view('pages.itinerary.create', $data);
    }

    /**
     * Store new data to database
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(ItineraryRequest $request)
    {
        // store the data to database
        $data = $this->itinerary->create($request->all());

        // Itinerary Galleries
        if ($request->has('galleries')) {
            // sync the media relationship
            $data->media()->attach($request->galleries);
        }

        // Featured Picture
        if ($request->has('featured_picture')) {
            // prevent duplicate
            $data->media()->detach($request->featured_picture);
            $data->media()->attach($request->featured_picture, ['is_featured' => true]);
        } else {
            $data->media()->detach(1);
            $data->media()->attach(1, ['is_featured' => true]);
        }

        /*
         * Category
         *
         * store the request categories then take the id
         */
        $categoryId = collect($request->categories)->map(function ($c) {
            // Retrieve category by slug or create it and return the id
            $category = $this->category->where('slug', $c)->first();

            if (empty($category->id)) {
                $category = $this->category->updateOrCreate([
                    'name' => $c,
                    'slug' => Str::slug($c, '-')
                ]);
            }

            return $category->id;
        });

        $data->categories()->sync($categoryId);

        /*
         * Districts
         *
         * store the request districts then take the id
         */
        $districtId = collect($request->districts)->map(function ($c) {
            // Retrieve district by slug or create it and return the id
            $district = $this->district->where('slug', $c)->first();

            if (empty($district->id)) {
                $district = $this->district->updateOrCreate([
                    'name' => $c,
                    'slug' => Str::slug($c, '-')
                ]);
            }

            return $district->id;
        });

        $data->districts()->sync($districtId);

        return redirect()->back()->with('success', 'Data added successfully!');
    }

    /**
     * Show an edit form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $data['itinerary'] = $this->itinerary->find($id);
        $data['categories'] = $this->category->get();
        $data['districts'] = $this->district->all();

        return view('pages.itinerary.edit', $data);
    }

    /**
     * Update a specified data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(ItineraryRequest $request, $id)
    {
        $data = $this->itinerary->find($id);

        // update itinerary
        $data->update($request->all());

        $currentFeaturedPicture = $data->media()->wherePivot('is_featured', true)->exists()
            ? $data->media()->wherePivot('is_featured', true)->first()->id
            : 1;
        $currentGalleries = $data->media()->wherePivot('is_featured', false)->get()->pluck('id');

        /* Galleries */
        if ($request->has('galleries')) {
            $currentGalleries = $request->galleries;
        }
        // Sync the gallery
        $data->media()->sync($currentGalleries);

        /* Featured Picture */
        if ($request->has('featured_picture')) {
            $currentFeaturedPicture = $request->featured_picture;
        }

        // Sync the featured picture
        $data->media()->syncWithoutDetaching([$currentFeaturedPicture => ['is_featured' => true]]);


        /*
         * Category
         *
         * store the request categories then take the id
         */
        $categoryId = collect($request->categories)->map(function ($c) {
            // Retrieve category by slug or create it and return the id
            $category = $this->category->where('slug', $c)->first();

            if (empty($category->id)) {
                $category = $this->category->updateOrCreate([
                    'name' => $c,
                    'slug' => Str::slug($c, '-')
                ]);
            }

            return $category->id;
        });

        /*
         * Districts
         *
         * store the request districts then take the id
         */
        $districtId = collect($request->districts)->map(function ($c) {
            // Retrieve district by slug or create it and return the id
            $district = $this->district->where('slug', $c)->first();

            if (empty($district->id)) {
                $district = $this->district->updateOrCreate([
                    'name' => $c,
                    'slug' => Str::slug($c, '-')
                ]);
            }

            return $district->id;
        });

        $data->categories()->sync($categoryId);
        $data->districts()->sync($districtId);


        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    /**
     * Remove a specified data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Itinerary $itinerary)
    {
        $itinerary->delete();

        return Session::flash('success', 'The itinerary has been removed!');
    }
}
