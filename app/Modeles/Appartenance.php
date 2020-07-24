<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Appartenance extends Model
{
    public $timestamps = false;
    protected $fillable = ['communaute_id', 'utilisateur_id'];
}
