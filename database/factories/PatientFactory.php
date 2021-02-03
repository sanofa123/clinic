<?php

use App\Models\Patient;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$M4Mafw/eo7zJi59UuxHWEu4CjijiaJ96ckvGqUUkP6rZWEpIrUpye', // 123456
        'remember_token' => str_random(10),
        'status' => $faker->numberBetween(0, 1),
        'date_of_birth' => $faker->date('Y-m-d', 'now'),
        'gender' => $faker->randomElement(['male', 'female']),
        'mobile' => $faker->phoneNumber,
    ];
});