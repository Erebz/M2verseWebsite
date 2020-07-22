<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;
    protected $fillable = ['date_message', 'texte', 'image'];

    public function auteurMessage(){
        return $this->belongsTo(Utilisateur::class, 'auteur', 'id');
    }

    public function publicationOrigine(){
        return $this->belongsTo(Publication::class, 'publication', 'id');
    }

    /*
    public function contenu(){
        return $this->hasOne(ContenuMessage::class);
    }*/
}
