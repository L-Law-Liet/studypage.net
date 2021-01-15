<?php

use App\LearnProgram;
use Illuminate\Database\Seeder;

class LearnProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(LearnProgram::class, 1000)->create();
    }
}
