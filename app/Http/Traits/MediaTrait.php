<?php

namespace App\Http\Traits;

use App\Media;
use Intervention\Image\Facades\Image;
use Storage;
use Str;

trait MediaTrait
{
    /**
     * Media file types
     *
     * @var String
     */
    protected $ITINERARY = 'Itinerary';
    protected $REVIEW = 'Review';

    /**
     * This will return required data to be passed to database
     *
     * @param file $file
     * @param string $fieldname
     *
     * @return array
     */
    public function getMediaFileInfo($file, $fieldname)
    {
        $media['name'] = Str::random() . "-{$fieldname}.{$file->getClientOriginalExtension()}";
        $media['type'] = $fieldname;
        $media['file_size'] = $file->getSize();
        $media['alt'] = $fieldname;

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
        $thumbPath = storage_path("app/public/{$media['type']}/thumb");

        // move the file to the path
        $file->storeAs("public/{$media['type']}", $media['name']);

        // check if the thumb path is exists
        if (!is_dir($thumbPath)) {
            mkdir($thumbPath, 0775, true);
        }

        // thumbnail
        Image::make($file)
            ->fit(300, 250)
            ->save("{$thumbPath}/{$media['name']}");

        // store the media info to database
        return Media::create($media);
    }
}
