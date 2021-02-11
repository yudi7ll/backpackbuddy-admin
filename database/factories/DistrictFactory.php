<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\District;
use Faker\Generator as Faker;

$factory->define(District::class, function (Faker $faker) {
    $district = $faker->city;
    return [
        'name' => $district,
        'slug' => Str::slug($district),
    ];
});
