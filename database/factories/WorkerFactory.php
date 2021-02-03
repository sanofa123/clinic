<?php

use App\Models\clinic;
use App\Models\worker;
use Faker\Generator as Faker;

$factory->define(worker::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'salary' => $faker->numberBetween(100, 1000),
        'date_of_birth' => $faker->date('Y-m-d', 'now'),
        'date_of_start' => $faker->date('Y-m-d', 'now'),
        'clinic_id' => function() {
        	return clinic::all()->random();
        },
        'position' => $faker->jobTitle,
        'mobile' => $faker->phoneNumber
    ];
});