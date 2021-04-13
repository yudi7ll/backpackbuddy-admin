<?php

namespace App;

use App\Services\OrderService;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];

    public function getStatusNameAttribute()
    {
        return OrderService::toStatusName($this->status);
    }

    /**
     * Get the itinerary that belongs to this order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function itinerary()
    {
        return $this->belongsTo('App\Itinerary');
    }

    /**
     * Get the customer that belongs to this order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
