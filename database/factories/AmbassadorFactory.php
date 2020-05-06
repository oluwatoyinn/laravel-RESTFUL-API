<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ambassador;
use Faker\Generator as Faker;

$factory->define(Ambassador::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' =>$faker->address,
        'email' =>$faker->safeEmail,
        'phone_number' =>$faker->phoneNumber,
        'guarantor' =>$faker->name,
        'location' =>$faker->company,
    ];
});
 