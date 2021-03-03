<?php

namespace App\Http\Traits;

use App\Media;
use Storage;
use Str;

trait MediaTrait
{
    /**
     * Media file types
     *
     * @var Array
     */
    protected $ITINERARY = 'Itinerary';
    protected $REVIEW = 'Review';

    /**
     * Verify the images
     *
     * @param $request
     * @param $file
     * @return true|false
     */
    public function verityImage($request, $file, $isFeatured = false)
    {
        if ($isFeatured) {
            if (! $file->isValid()) {
                return redirect()->back()->with('error', 'Invalid Picture')->withInput();
            }

            return $request->validate(['featured_picture' => 'image']);
        } else {
            foreach ($file as $f) {
                if (! $f->isValid()) {
                    return redirect()->back()->with('error', 'Invalid Picture')->withInput();
                }
            }

            return $request->validate(['images' => 'array']);
        }
    }

    /**
     * This will return required data to be passed to database
     *
     * @param file $file
     * @param int $itineraryId
     * @param string $fieldname
     *
     * @return array
     */
    public function getMediaFileInfo($file, $fieldname)
    {
        $media['name'] = Str::random() . "{$fieldname}.{$file->getClientOriginalExtension()}";
        $media['path'] = "public/{$fieldname}";
        $media['uri'] = Storage::disk('public')->url("{$fieldname}/{$media['name']}");
        $media['file_size'] = $file->getSize();
        $media['alt'] = "{$fieldname}-{$media['name']}";

        return $media;
    }

    /**
     * Save the image to public disk
     *
     * @param file $file
     * @param string $filename
     * @return int|id
     */
    public function storeImage($file, $fieldname)
    {
        // retrieve all required information
        $media = $this->getMediaFileInfo($file, $fieldname);

        // move the file to the path
        $file->storeAs($media['path'], $media['name']);

        // store the media info to database
        return Media::create($media);
    }
}
