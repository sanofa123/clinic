  
<?php

use App\Models\clinic;
use App\Models\nurse;
use Faker\Generator as Faker;

$factory->define(nurse::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$M4Mafw/eo7zJi59UuxHWEu4CjijiaJ96ckvGqUUkP6rZWEpIrUpye', // 123456
        'remember_token' => str_random(10),
        'status' => $faker->numberBetween(0, 1),
        'mobile' => $faker->phoneNumber,
        'date_of_birth' => $faker->date('Y-m-d', 'now'),
        'gender' => $faker->randomElement(['male', 'female']),
        'salary' => $faker->numberBetween(1000, 5000),
        'start_day'=>$faker->dayOfWeek(),
        'end_day'=>$faker->dayOfWeek(),
        'start_time'=>$faker->time(),
        'end_time'=>$faker->time(),
        'clinic_id' => function() {
        	return clinic::all()->random();
        },
    ];
});