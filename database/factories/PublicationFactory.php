<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modeles\Publication;
use Faker\Generator as Faker;

$factory->define(Publication::class, function (Faker $faker) {
    return [
        'titre' => $faker->sentence(5, true),
        'texte' => $faker->sentence(15, true),
        'image' => $faker->sentence(1, false) . "png",
        'spoiler' => $faker->boolean,
        'auteur' => $faker->numberBetween(1, 10),
        'communaute' => $faker->numberBetween(1, 3),
        'date_publication' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
