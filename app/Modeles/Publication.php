<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public $timestamps = false;
    protected $fillable = ['spoiler', 'date', 'titre', 'texte', 'image'];

    public function utilisateur(){
        return $this->belongsTo(Utilisateur::class, 'utilisateur');
    }

    public function communaute(){
        return $this->belongsTo(Communaute::class, 'communaute');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'publication');
    }

    /*
    public function contenu(){
        return $this->hasOne(ContenuMessage::class);
    }*/
}
