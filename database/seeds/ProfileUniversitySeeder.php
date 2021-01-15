<?php

use App\ProfileUniversity;
use Illuminate\Database\Seeder;

class ProfileUniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProfileUniversity::class, 400)->create();
    }
}
