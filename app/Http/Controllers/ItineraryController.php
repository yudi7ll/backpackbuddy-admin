<?php

namespace App\Http\Controllers;

use App\Category;
use App\District;
use App\Http\Requests\ItineraryRequest;
use App\Http\Traits\MediaFileTrait;
use App\Itinerary;
use App\MediaFile;
use Session;
use Storage;
use Str;

class ItineraryController extends Controller
{
    use MediaFileTrait;

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
        $this->data['itineraries'] = $this->itinerary->all();
        $this->data['categories'] = $this->category->all();
        $this->data['districts'] = $this->district->all();

        return view('pages.itinerary.index', $this->data);
    }

    /**
     * Display a create itinerary form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $this->data['categories'] = $this->category->all();
        $this->data['districts'] = $this->district->all();

        return view('pages.itinerary.create', $this->data);
    }

    /**
     * Store new data to database
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(ItineraryRequest $request)
    {
        // store the data to database
        $this->data = $this->itinerary->create($request->all());

        // Featured Picture
        if ($request->hasFile('featured_picture')) {
            if (! $request->file('featured_picture')->isValid()) {
                return redirect()->back()
                                 ->with('error', 'Invalid picture!')
                                 ->withInput();
            }

            $file = $request->file('featured_picture');
            $mediafile = $this->getMediaFileInfo($file, $this->data['id']);

            // store the image file
            $this->storeImage($file, $mediafile['path'], $mediafile['name']);

            // store the media info to database
            $this->mediafileId = MediaFile::create($mediafile)->id;

            // sync the mediafile relationship
            $this->data->mediafiles()->sync($this->mediafileId);
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

        $this->data->categories()->sync($categoryId);

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

        $this->data->districts()->sync($districtId);

        return redirect()->back()->with('success', 'Data added successfully!');
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
        $this->data['districts'] = $this->district->all();

        return view('pages.itinerary.edit', $this->data);
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

        /*
         * Featured Picture
         */
        if ($request->file('featured_picture')) {
            $file = $request->file('featured_picture');
            $imageName = "itinerary-{$this->data->id}.{$request->file('featured_picture')->getClientOriginalExtension()}";

            // store the file to public directory
            $file->storeAs('public/featured_picture', $imageName);

            // save the filename
            $this->data->featured_picture = $imageName;
            $this->data->save();
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

        $this->data->categories()->sync($categoryId);
        $this->data->districts()->sync($districtId);


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
