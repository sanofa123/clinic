<?php

use App\Models\clinic;
use Faker\Generator as Faker;

$factory->define(clinic::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'telephone' => $faker->tollFreePhoneNumber,
        'start_time' => $faker->time(),
        'end_time' => $faker->time(),
    ];
});