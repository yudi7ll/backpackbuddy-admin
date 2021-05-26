<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Storage;

class MediaController extends Controller
{

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
}
