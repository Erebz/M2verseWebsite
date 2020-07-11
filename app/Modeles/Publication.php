<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public $timestamps = false;
    protected $fillable = ['spoiler', 'date_publication', 'titre', 'texte', 'image', 'auteur', 'communaute'];

    public function auteurPublication(){
        return $this->belongsTo(Utilisateur::class, 'auteur');
    }

    public function communautePublication(){
        return $this->belongsTo(Communaute::class, 'communaute');
    }

    public function reponsesPublication(){
        return $this->hasMany(Message::class, 'publication');
    }

    public function likes(){
        return $this->belongsToMany(Utilisateur::class, 'likes');
    }

    /*
    public function contenu(){
        return $this->hasOne(ContenuMessage::class);
    }*/
}
