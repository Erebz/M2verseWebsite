<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modeles\Utilisateur;
use Faker\Generator as Faker;

$factory->define(Utilisateur::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'pseudo' => $faker->name,
        'password' => $faker->sentence(3, true),
        'mail' => $faker->email,
        'anniversaire' => $faker->date("Y-m-d")
    ];
});
