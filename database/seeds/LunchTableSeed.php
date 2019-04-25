<?php

use Illuminate\Database\Seeder;

class LunchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Http\Models\Lunch::class,2)->create();
    }
}
