<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'email_verified_at' => Carbon::now(),
        'password' => bcrypt('password'),
    ];
});
