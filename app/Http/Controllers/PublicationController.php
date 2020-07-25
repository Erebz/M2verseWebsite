<?php

namespace App\Http\Controllers;

use App\Modeles\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function show(Publication $publication){
        //TODO : trier les réponses par date
        $comments = $publication->reponsesPublication;
        $author = $publication->auteurPublication;
        $title = $publication->titre;
        $community = $publication->communautePublication;
        $date = $publication->date_publication;
        $body = $publication->texte;
        $image = $publication->image;
        return view('afficherPublication', compact('publication', 'comments', 'author', 'title', 'community', 'date', 'body', 'image'));
    }
}
