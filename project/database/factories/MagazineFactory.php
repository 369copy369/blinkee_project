<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Magazine;
use Faker\Generator as Faker;

$factory->define(Magazine::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName(),
        'publisher_id' => $faker->numberBetween(1, 50)
    ];
});
