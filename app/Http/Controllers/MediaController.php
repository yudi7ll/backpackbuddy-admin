<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Http\Traits\MediaTrait;
use App\Media;
use Response;
use Storage;
use Validator;

class MediaController extends Controller
{
    use MediaTrait;

    /**
     * Create a new controller instance
     *
     * @return void
     */
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
        $uploadedImage = $this->storeImage($request->file('image'), 'Itinerary');

        if ($request->ajax()) {
            return response()->json([
                'id' => $uploadedImage->id,
                'alt' => $uploadedImage->alt,
                'thumbnail_url' => $uploadedImage->thumbnail_url,
                'url' => $uploadedImage->url
            ]);
        }

        return redirect()->back()->with('success', 'Data has been uploaded!');
    }

    /**
     * Show the specified data form
     *
     * @param \App\Media $media
     */
    public function edit($id)
    {
        $this->data['media'] = $this->media->findOrFail($id);
        return view('pages.media.edit-modal', $this->data);
    }

    /**
     * Update the specified data
     *
     * @param $id
     */
    public function update($id)
    {
        $this->data = Validator::make(request()->all(), ['alt' => 'string']);
        return $this->media->find($id)->update(request()->all());
    }

    /**
     * Get the image
     *
     * @param string $filename
     * @return Response
     */
    public function getMedia($filename, $thumb = null)
    {
        $storage = Storage::disk('public');
        $path = "Itinerary/$thumb/$filename";

        if (!$storage->exists($path)) {
            abort(404);
        }

        $file = $storage->get($path);
        $type = $storage->mimeType($path);

        return Response::make($file)->header('Content-Type', $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* TODO: Delete the file */
        return $this->media->find($id)->delete();
    }
}
