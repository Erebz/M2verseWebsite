<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modeles\Communaute;
use Faker\Generator as Faker;

$factory->define(Communaute::class, function (Faker $faker) {
    return [
        'nom' => $faker->sentence(3, true),
        'description' => $faker->sentence(12, true),
    ];
});
