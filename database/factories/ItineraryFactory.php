<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Itinerary;
use Faker\Generator as Faker;

$factory->define(Itinerary::class, function (Faker $faker) {
    $price = $faker->numberBetween(10000, 10000000);
    return [
        'place_name' => $faker->city,
        'price' => $price,
        'sale' => $faker->numberBetween(10000, $price),
        'excerpt' => $faker->realText(50),
        'description' => $faker->realText(200),
        'is_published' => $faker->boolean,
    ];
});
