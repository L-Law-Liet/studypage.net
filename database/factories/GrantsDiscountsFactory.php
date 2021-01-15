<?php

/** @var Factory $factory */

use App\GrantsDiscounts;
use App\Models\University;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(GrantsDiscounts::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'count_grants' => random_int(10, 100),
        'university_id' => University::inRandomOrder()->first()->id
    ];
});
