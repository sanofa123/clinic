<?php

use App\Models\Patient;
use App\Models\admin;
use App\Models\image;
use Faker\Generator as Faker;

$factory->define(image::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl(640, 480),
        'caption' => $faker->realText(100),
        'patient_id' => function() {
        	return Patient::all()->random();
        },
        'admin_id' => function() {
        	return admin::all()->random();
        },
    ];
});