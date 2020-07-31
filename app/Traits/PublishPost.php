<?php

namespace App\Traits;

use App\Modeles\Communaute;
use App\Modeles\Utilisateur;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

trait PublishPost
{
    public function publish($fields, Communaute $community, Utilisateur $author)
    {
        if($fields->image && $fields->image != ''){
            $data = base64_decode($fields->image);
            $filename = uniqid("drawing_") . ".png";
            File::put('storage/'.$filename, $data);
        }

        $publication = \App\Modeles\Publication::create([
            'spoiler' => $fields->spoiler!=null,
            'date_publication' => now(),
            //'date_publication' => now()->toDateTimeString('Y-m-d'),
            'titre' => $fields->title ?? '',
            'texte' => $fields->body ?? '',
            'image' => $filename ?? '',
            'auteur' => $author->id,
            'communaute' => $community->id,
        ]);
        return $publication;
    }
}
