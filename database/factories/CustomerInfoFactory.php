<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CustomerInfo;
use Faker\Generator as Faker;

$factory->define(CustomerInfo::class, function (Faker $faker) {
    return [
        'address_1' => $faker->streetAddress,
        'address_2' => $faker->streetAddress,
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'identity' => $faker->creditCardNumber,
        'telp' => $faker->phoneNumber
    ];
});
