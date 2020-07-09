<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom', 'pseudo', 'mail', 'password', 'anniversaire'];

    public function publications(){
        return $this->hasMany(Publication::class, 'auteur');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'auteur');
    }

    public function communautes(){
        return $this->belongsToMany(Communaute::class, 'appartenances');
    }

    public function amis(){
        return $this->belongsToMany(Utilisateur::class, 'amis', 'ami1', 'ami2');
    }
}
