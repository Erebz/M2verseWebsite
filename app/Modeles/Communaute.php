<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Communaute extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom', 'description'];

    public function publications(){
        return $this->hasMany(Publication::class, 'communaute');
    }

    public function membres(){
        return $this->belongsToMany(Utilisateur::class, 'appartenances');
    }
}
