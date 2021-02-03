<?php

use App\Models\category;
use App\Models\clinic;
use App\Models\material;
use Faker\Generator as Faker;

$factory->define(material::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'clinic_id' => function() {
        	return clinic::all()->random();
        },
        'category_id' => function() {
        	return category::all()->random();
        },
        'num' => $faker->numberBetween(10, 100),
        'min_num' => $faker->numberBetween(10, 100),
        'cost' => $faker->numberBetween(10, 100),
    ];
});