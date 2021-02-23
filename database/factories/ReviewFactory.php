<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Itinerary;
use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'customer_id' => $faker->numberBetween(1, Customer::all()->count()),
        'itinerary_id' => $faker->numberBetween(1, Itinerary::all()->count()),
        'content' => $faker->realText($faker->numberBetween(50, 255)),
        'rating' => $faker->numberBetween(1, 5),
    ];
});
