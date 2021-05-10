<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Itinerary;
use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $itinerary = Itinerary::find($faker->numberBetween(1, Itinerary::count()));

    return [
        'customer_id' => Customer::find($faker->numberBetween(1, Customer::count())),
        'itinerary_id' => $itinerary,
        'price' => $itinerary->sale ?: $itinerary->price,
        'status' => $faker->numberBetween(1, 3),
        'code' => uniqid()
    ];
});
