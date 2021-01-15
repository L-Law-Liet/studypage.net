<?php

use App\Models\CostEducation;
use App\Models\Degree;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CostEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $costs = CostEducation::all();

        $costs->each(function ($cost_update, $key) {
            $faker = Factory::create();
            $cost_update->income = $faker->randomElement(['После школы', 'После колледжа']);
            $cost_update->education_form = $faker->randomElement(['Очная (дневная)', 'Дистанционная']);
            $cost_update->degree_id = Degree::inRandomOrder()->first()->id;
            $cost_update->passing_score = random_int(50, 140);
            $cost_update->save();
        });
    }
}
