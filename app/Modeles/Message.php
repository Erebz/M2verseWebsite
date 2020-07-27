<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Message extends Model
{
    public $timestamps = false;
    protected $fillable = ['date_message', 'texte', 'image', 'auteur', 'publication'];

    public function auteurMessage(){
        return $this->belongsTo(Utilisateur::class, 'auteur', 'id');
    }

    public function publicationOrigine(){
        return $this->belongsTo(Publication::class, 'publication', 'id');
    }

    public function likes(){
        return $this->belongsToMany(Utilisateur::class, 'like_comments', 'comment_id', 'utilisateur_id');
    }

    public function likedByUser(){
        $likes = $this->likes;
        $user = Session::get('user');
        return $likes->contains($user);
    }

    /*
    public function contenu(){
        return $this->hasOne(ContenuMessage::class);
    }*/
}
