<?php

use App\Models\Patient;
use App\Models\admin;
use App\Models\comment;
use Faker\Generator as Faker;

$factory->define(comment::class, function (Faker $faker) {
    $random = rand(0,6);
    
    switch ($random) {
        case 1:
            $content = "<h1>" . $faker->paragraph . "</h1>";
            break;

        case 2:
            $content = "<h2>" . $faker->paragraph . "</h2>";
            break;

        case 3:
            $content = "<h3>" . $faker->paragraph . "</h3>";
            break;

        case 4:
            $content = "<h4>" . $faker->paragraph . "</h4>";
            break;

        case 5:
            $content = "<h5>" . $faker->paragraph . "</h5>";
            break;

        case 6:
            $content = "<h6>" . $faker->paragraph . "</h6>";
            break;
        
        default:
            $content = "<p>" . $faker->paragraph . "</p>";
            break;
    }
    
    return [
        'content' => $content,
        'patient_id' => function() {
        	return Patient::all()->random();
        },
        'admin_id' => function() {
        	return admin::all()->random();
        },
    ];
});