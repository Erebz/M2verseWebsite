<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Modeles\Communaute;
use App\Modeles\Like;
use App\Modeles\Publication;
use App\Traits\PublishPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PublicationController extends Controller
{
    use PublishPost;

    public function show(Publication $publication){
        //TODO : trier les réponses par date
        $comments = $publication->reponsesPublicationOrderByDate(false);
        $author = $publication->auteurPublication;
        $title = $publication->titre;
        $community = $publication->communautePublication;
        $date = $publication->date_publication;
        $body = $publication->texte;
        $image = $publication->image;
        return view('afficherPublication', compact('publication', 'comments', 'author', 'title', 'community', 'date', 'body', 'image'));
    }

    public function like(Publication $publication){
        if(!$publication->likedByUser()){
            $user = Session::get('user');
            Like::create([
                'utilisateur_id' => $user->id,
                'publication_id' => $publication->id,
            ]);
        }
        //return back()->send();
    }

    public function dislike(Publication $publication){
        if($publication->likedByUser()){
            $user = Session::get('user');
            $like = Like::where('utilisateur_id', $user->id)->where('publication_id', $publication->id);
            $like->delete();
        }
        //return back()->send();
    }

    public function store(PublicationRequest $request, Communaute $com){
        $this->publish($request, $com, Session::get('user'));
        return back()->send();
    }
}