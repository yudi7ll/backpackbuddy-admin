<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\DistrictRequest;
use Session;

class DistrictController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(District $district)
    {
        $this->middleware('auth');
        $this->district = $district;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['districts'] = $this->district->all();

        return view('district.index', $this->data);
    }

    /**
     * Display a single district with the Itinerary
     *
     * @param \App\District $district
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(District $district)
    {
        return view('district.show', compact('district'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {
        $this->district->create($request->all());

        return redirect()->back()->with('success', 'Data has been saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        return view('district.edit', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, District $district)
    {
        $district->update($request->all());

        return redirect()->back()->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();

        return Session::flash('success', 'Data has been deleted successfully!');
    }
}
