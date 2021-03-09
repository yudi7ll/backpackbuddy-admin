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
        'name', 'url', 'thumbnail_url', 'alt', 'file_size', 'type',
    ];

    /**
     * Get the itineraries that belongs to this media file
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function itineraries()
    {
        return $this->belongsToMany('App\Itinerary')->withPivot('isFeatured');
    }
}
