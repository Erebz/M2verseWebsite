<?php

namespace App\Traits;

use App\Modeles\Communaute;
use App\Modeles\Utilisateur;
use Illuminate\Support\Facades\Hash;

trait PublishPost
{
    public function publish($fields, Communaute $community, Utilisateur $author)
    {
        $publication = \App\Modeles\Publication::create([
            'spoiler' => $fields->spoiler!=null,
            'date_publication' => now(),
            //'date_publication' => now()->toDateTimeString('Y-m-d'),
            'titre' => $fields->title ?? '',
            'texte' => $fields->body ?? '',
            'image' => $fields->image ?? '',
            'auteur' => $author->id,
            'communaute' => $community->id,
        ]);
        return $publication;
    }
}
