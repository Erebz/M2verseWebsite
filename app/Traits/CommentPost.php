<?php

namespace App\Traits;

use App\Modeles\Publication;
use App\Modeles\Utilisateur;

trait CommentPost
{
    public function comment($fields, Publication $publication, Utilisateur $author)
    {
        $message = \App\Modeles\Message::create([
            'date_message' => now(),
            'texte' => $fields->body ?? '',
            'image' => $fields->image ?? '',
            'auteur' => $author->id,
            'publication' => $publication->id,
        ]);
        return $message;
    }
}
