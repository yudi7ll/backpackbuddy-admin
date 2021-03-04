<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Http\Traits\MediaTrait;
use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    use MediaTrait;

    public function __construct(Media $media)
    {
        $this->middleware('auth');
        $this->media = $media;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['media'] = $this->media->latest()->get();
        return view('pages.media.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\MediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        return $this->storeImage($request->file('image'), $this->ITINERARY);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
