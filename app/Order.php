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
    protected $fillable = ['status'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['completed_at'];

    /**
     * Get the status name based on status code
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        return OrderService::toStatusName($this->status);
    }

    /**
     * Get the date order has been completed
     *
     * @return string
     */
    public function getCompletedAtAttribute($value)
    {
        return $value ? $value->toDayDateTimeString() : '-';
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
