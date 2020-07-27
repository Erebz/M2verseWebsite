<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Communaute extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom', 'description'];
    //protected $primaryKey = 'id';

    public function publications(){
        return $this->hasMany(Publication::class, 'communaute');
    }

    public function publicationsOrderByDate($asc = false){
        if($asc){
            return $this->hasMany(Publication::class, 'communaute')->orderBy('date_publication', 'asc')->get();
        }else{
            return $this->hasMany(Publication::class, 'communaute')->orderBy('date_publication', 'desc')->get();
        }
    }

    public function membres(){
        return $this->belongsToMany(Utilisateur::class, 'appartenances', 'communaute_id', 'utilisateur_id');
    }
}
