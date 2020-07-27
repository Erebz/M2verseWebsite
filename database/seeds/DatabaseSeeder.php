<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        /* factory(App\Modeles\Utilisateur::class, 10)->create();
        factory(App\Modeles\Communaute::class, 3)->create();
        factory(App\Modeles\Publication::class, 10)->create();
        factory(App\Modeles\Message::class, 15)->create();*/
        \App\Modeles\Communaute::create([
            'nom' => "Le Souc",
            'description' => 'Faites ce que vous voulez ici! ✌😳',
        ]);
        \App\Modeles\Communaute::create([
            'nom' => "Youtube",
            'description' => 'Il faut parler exclusivement de Youtube ici!!!',
        ]);
        \App\Modeles\Utilisateur::create([
            'nom' => "Yacine",
            'pseudo' => "Erebz",
            'password' => "123456",
            'mail' => "erebz@erebz.fr",
            'anniversaire' => "1999-5-13",
        ]);
    }
}
