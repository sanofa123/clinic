<?php

use App\Models\Patient;
use App\Models\admin;
use App\Models\prescription;
use Faker\Generator as Faker;

$factory->define(prescription::class, function (Faker $faker) {
    $random = rand(0,6);
    
    switch ($random) {
        case 1:
            $name = "<h1>" . $faker->paragraph . "</h1>";
            break;

        case 2:
            $name = "<h2>" . $faker->paragraph . "</h2>";
            break;

        case 3:
            $name = "<h3>" . $faker->paragraph . "</h3>";
            break;

        case 4:
            $name = "<h4>" . $faker->paragraph . "</h4>";
            break;

        case 5:
            $name = "<h5>" . $faker->paragraph . "</h5>";
            break;

        case 6:
            $name = "<h6>" . $faker->paragraph . "</h6>";
            break;
        
        default:
            $name = "<p>" . $faker->paragraph . "</p>";
            break;
    }

    return [
        'name' => $name,
        'patient_id' => function() {
        	return Patient::all()->random();
        },
        'admin_id' => function() {
        	return admin::all()->random();
        },
    ];
});