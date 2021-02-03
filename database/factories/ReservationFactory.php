  
<?php

use App\Models\Patient;
use App\Models\admin;
use App\Models\clinic;
use App\Models\nurse;
use App\Models\reservation;
use Faker\Generator as Faker;

$factory->define(reservation::class, function (Faker $faker) {
    return [
        'clinic_id' => function() {
        	return clinic::all()->random();
        },
        'nurse_id' => function() {
        	return nurse::all()->random();
        },
        'admin_id' => function() {
        	return admin::all()->random();
        },
        'patient_id' => function() {
        	return Patient::all()->random();
        },
        'time' => $faker->dateTime('now'),
        'attend' => $faker->numberBetween(0, 1)
    ];
});