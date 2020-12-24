<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Itinerary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place_name', 'categories', 'price', 'excerpt', 'description',
    ];

    /**
     * Get the category for the Itinerary
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
