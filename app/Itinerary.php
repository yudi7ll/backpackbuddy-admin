<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place_name',
        'categories',
        'price',
        'sale',
        'excerpt',
        'description',
        'is_published',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Get the category for the Itinerary
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Get the district for the Itinerary
     */
    public function districts()
    {
        return $this->belongsToMany('App\District');
    }
}
