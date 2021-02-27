<?php

namespace App\Http\Traits;

use App\MediaFile;
use Storage;
use Str;

trait MediaFileTrait
{
    /**
     * Media file types
     *
     * @var Array
     */
    protected $GALLERIES = 'galleries';
    protected $FEATURED_PICTURE = 'featured_picture';

    /**
     * Verify the images
     *
     * @param $request
     * @param string $fieldname
     * @return true|false
     */
    public function verityImage($request, $fieldname)
    {
        $file = $request->file($fieldname);
        if (is_array($file)) {
            foreach ($file as $f) {
                if (! $f->isValid()) {
                    return redirect()->back()->with('error', 'Invalid Picture')->withInput();
                }
            }

            return $request->validate([$fieldname => 'array']);
        } else {
            if (! $file->isValid()) {
                return redirect()->back()->with('error', 'Invalid Picture')->withInput();
            }

            return $request->validate([$fieldname => 'image']);
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
        $mediafile['name'] = Str::random() . "{$fieldname}.{$file->getClientOriginalExtension()}";
        $mediafile['path'] = "public/{$fieldname}";
        $mediafile['uri'] = Storage::disk('public')->url("{$fieldname}/{$mediafile['name']}");
        $mediafile['file_size'] = $file->getSize();

        return $mediafile;
    }

    /**
     * Save the image to public disk
     *
     * @param file $file
     * @param string $path
     * @param string $filename
     * @return $this
     */
    public function storeImage($file, $fieldname)
    {
        // retrieve all required information
        $mediafile = $this->getMediaFileInfo($file, $fieldname);

        // store the media info to database
        $mediafile['id'] = MediaFile::create($mediafile)->id;

        // move the file to the path
        $file->storeAs($mediafile['path'], $mediafile['name']);

        // sync the mediafile relationship
        $this->data->mediafiles()->attach($mediafile['id']);
    }
}
