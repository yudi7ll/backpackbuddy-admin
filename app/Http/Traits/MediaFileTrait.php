<?php

namespace App\Http\Traits;

use Request;
use Storage;

trait MediaFileTrait
{
    /**
     * This will return required data to be passed to database
     *
     * @param file $file
     * @param int $itineraryId
     * @param string $fieldname
     *
     * @return array
     */
    public function getMediaFileInfo($file, $itineraryId, $fieldname = 'featured_picture')
    {
        $mediafile['name'] = "{$fieldname}-{$itineraryId}.{$file->getClientOriginalExtension()}";
        $mediafile['path'] = "public/{$fieldname}";
        $mediafile['uri'] = Storage::disk('public')->url("{$fieldname}/{$mediafile['name']}");
        $mediafile['file_size'] = $file->getSize();
        $mediafile['type'] = $fieldname;

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
    public function storeImage($file, $path, $filename)
    {
        return $file->storeAs($path, $filename);
    }
}
