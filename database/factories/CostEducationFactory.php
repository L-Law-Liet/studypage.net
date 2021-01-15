<?php

use App\Models\CostEducation;
use App\Models\Degree;
use Faker\Generator as Faker;

$factory->define(CostEducation::class, function (Faker $faker) {
    return [
        'income' => $faker->randomElement(['После школы', 'После 9 класса']),
        'education_form' => $faker->randomElement(['Очная (дневная)', 'Дистанционная']),
        'degree_id' => Degree::inRandomOrder()->first()->id
    ];
});
