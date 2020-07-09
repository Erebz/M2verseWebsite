<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;
    protected $fillable = ['date_message', 'texte', 'image'];

    public function utilisateur(){
        return $this->belongsTo(Utilisateur::class, 'auteur');
    }

    public function publication(){
        return $this->belongsTo(Publication::class, 'publication');
    }

    /*
    public function contenu(){
        return $this->hasOne(ContenuMessage::class);
    }*/
}
