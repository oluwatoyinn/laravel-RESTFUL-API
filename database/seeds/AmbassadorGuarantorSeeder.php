<?php

use Illuminate\Database\Seeder;

class AmbassadorGuarantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(AmbassadorGuarantor::class, 5)->create();

    }
}
