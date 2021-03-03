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
     * Filter the itinerary whether is published or not
     *
     * @return \App\Itinerary
     */
    public function isPublished()
    {
        return $this->where('is_published', 1);
    }

    /**
     * Get the category for the Itinerary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Get the district for the Itinerary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function districts()
    {
        return $this->belongsToMany('App\District');
    }

    /**
     * Get the reviews that this itinerary has
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /**
     * Get the mediafiles that this itinerary has
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function media()
    {
        return $this->belongsToMany('App\Media');
    }
}
