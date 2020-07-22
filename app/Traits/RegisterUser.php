<?php

namespace App\Traits;

use App\Modeles\Utilisateur;
use Illuminate\Support\Facades\Hash;

trait RegisterUser
{
    public function registerUser($fields)
    {
        $user = \App\Modeles\Utilisateur::create([
            'nom' => $fields->nom,
            'pseudo' => $fields->pseudo,
            'anniversaire' => $fields->anniversaire,
            'password' => Hash::make($fields->password),
            'mail' => $fields->mail,
        ]);
        return $user;
    }
}
