<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'slug', 'is_published' ];

    /**
     * Determine whether the category is published or not
     */
    public function isPublished()
    {
        return $this->where('is_published', true);
    }

    /**
     * Get the Itinerary that belongs to the category.
     */
    public function itineraries()
    {
        return $this->belongsToMany('App\Itinerary');
    }
}
