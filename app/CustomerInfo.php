<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_1', 'address_2', 'postcode', 'city', 'identity', 'telp'
    ];


    /**
     * Get the Customer that belongs to this customer infos
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
