<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'slug' ];

    /**
     * Get the Itinerary that belongs to the category.
     */
    public function itineraries()
    {
        return $this->belongsToMany('App\Itinerary');
    }
}
