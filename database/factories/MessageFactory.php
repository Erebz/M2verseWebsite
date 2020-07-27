<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modeles\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'texte' => $faker->sentence(15, true),
        'image' => $faker->sentence(1, false) . "png",
        'auteur' => $faker->numberBetween(1, 10),
        'publication' => $faker->numberBetween(1, 10),
        'date_message' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
