<?php

use App\Models\University;
use App\Profile;
use App\ProfileUniversity;
use Faker\Generator as Faker;

$factory->define(ProfileUniversity::class, function (Faker $faker) {
    return [
        'university_id' => University::inRandomOrder()->first()->id,
        'profile_id' => Profile::inRandomOrder()->first()->id
    ];
});
