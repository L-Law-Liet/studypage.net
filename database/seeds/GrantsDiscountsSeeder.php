<?php

use Illuminate\Database\Seeder;

class GrantsDiscountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\GrantsDiscounts::class, 400)->create();
    }
}
