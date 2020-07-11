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
        factory(App\Modeles\Utilisateur::class, 10)->create();
        factory(App\Modeles\Communaute::class, 3)->create();
        factory(App\Modeles\Publication::class, 10)->create();
        factory(App\Modeles\Message::class, 15)->create();
    }
}
