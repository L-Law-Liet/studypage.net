<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\University;
use Faker\Generator as Faker;

$factory->define(University::class, function (Faker $faker) {
    return [
        'short_description' => $faker->sentence(80),
        'description' => $faker->sentence(180),
        'achievements' => $faker->sentence(180),
        'coop' => $faker->sentence(180),
        'rating' => $faker->sentence(180),
        'docs_income' => $faker->sentence(180)
    ];
});

