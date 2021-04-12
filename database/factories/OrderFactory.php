<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Itinerary;
use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => Customer::find($faker->numberBetween(0, Customer::count())),
        'itinerary_id' => Itinerary::find($faker->numberBetween(0, Itinerary::count())),
        'status' => 'Pending'
    ];
});
