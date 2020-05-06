<?php

use Illuminate\Database\Seeder;
use App\Ambassador;

class AmbassadorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ambassador::class, 30)->create();
    }
}
