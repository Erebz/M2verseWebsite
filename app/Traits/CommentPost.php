<?php

namespace App\Traits;

use App\Modeles\Publication;
use App\Modeles\Utilisateur;
use Illuminate\Support\Facades\Storage;

trait CommentPost
{
    public function comment($fields, Publication $publication, Utilisateur $author)
    {
        if($fields->image){
            $data = base64_decode($fields->image);
            //dd($data);
            //dd(Storage::get('/drawings/file.txt'));
            $filename = Storage::put('drawings', $data);
            dd($filename);
        }
        return \App\Modeles\Message::create([
            'date_message' => now(),
            'texte' => $fields->body ?? '',
            'image' => $filename ?? '',
            'auteur' => $author->id,
            'publication' => $publication->id,
        ]);
    }
}
