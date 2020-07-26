<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['utilisateur_id', 'publication_id'];
}
