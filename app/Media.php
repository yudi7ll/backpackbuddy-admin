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

    public function getUrlAttribute()
    {
        return url("get-media/{$this->name}");
    }

    public function getThumbnailUrlAttribute()
    {
        return url("get-media/{$this->name}/thumb");
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
