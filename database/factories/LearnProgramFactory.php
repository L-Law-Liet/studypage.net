<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LearnProgram;
use App\Models\Degree;
use App\Models\University;
use Faker\Generator as Faker;

$factory->define(LearnProgram::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'has' => $faker->boolean(85),
        'university_id' => University::inRandomOrder()->first()->id,
        'degree_id' => Degree::inRandomOrder()->first()->id
    ];
});
