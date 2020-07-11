<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;
    protected $fillable = ['date_message', 'texte', 'image'];

    public function auteurMessage(){
        return $this->belongsTo(Utilisateur::class, 'auteur');
    }

    public function publicationOrigine(){
        return $this->belongsTo(Publication::class, 'publication');
    }

    /*
    public function contenu(){
        return $this->hasOne(ContenuMessage::class);
    }*/
}
