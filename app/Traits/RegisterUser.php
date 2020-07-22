<?php

namespace App\Traits;

trait RegisterUser
{
    public function registerUser($fields)
    {
        //var_dump($fields->password);
        //die();
        $user = \App\Modeles\Utilisateur::create([
            'nom' => $fields->nom,
            'pseudo' => $fields->pseudo,
            'anniversaire' => $fields->anniversaire,
            'password' => $fields->password,
            'mail' => $fields->mail,

        ]);
        return $user;
    }
}
