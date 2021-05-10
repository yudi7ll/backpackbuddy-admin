<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

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
        $type = $this->attributes['type'];
        $name = $this->attributes['name'];

        return Storage::disk('public')->url("{$type}/{$name}");
    }

    public function getThumbnailUrlAttribute()
    {
        $type = $this->attributes['type'];
        $name = $this->attributes['name'];

        return Storage::disk('public')->url("{$type}/thumb/{$name}");
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
