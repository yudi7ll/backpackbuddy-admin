<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Http\Traits\MediaTrait;
use App\Media;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\MediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        $uploadedImage = $this->storeImage($request->file('image'), $this->ITINERARY);

        if ($request->ajax()) {
            return $uploadedImage;
        }

        return redirect()->back()->with('success', 'Data has been uploaded!');
    }

    /**
     * Show the specified data form
     *
     * @param \App\Media $media
     */
    public function edit(Media $media)
    {
        return view('pages.media.edit', compact('media'))->toHtml();
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
