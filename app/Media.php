<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alt', 'file_size', 'type',
    ];

    public function getUrlApiAttribute()
    {
        return url("api/get-media/{$this->name}");
    }

    public function getUrlAttribute()
    {
        return url("get-media/{$this->name}");
    }

    public function getThumbnailUrlAttribute()
    {
        return url("get-media/{$this->name}/thumb");
    }

    public function getThumbnailUrlApiAttribute()
    {
        return url("api/get-media/{$this->name}/thumb");
    }

    public function getFilesizeAttribute($filesize)
    {
        $byte = 1024;
        if ($filesize / $byte / $byte < 1) {
            return number_format($filesize / $byte, 1) . ' KB';
        }

        return number_format($filesize / $byte / $byte, 1) . ' MB';
    }

    /**
     * Get the itineraries that belongs to this media file
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function itineraries()
    {
        return $this->belongsToMany('App\Itinerary')->withPivot('is_featured');
    }
}
