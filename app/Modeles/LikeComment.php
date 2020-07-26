<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
    protected $fillable = ['utilisateur_id', 'comment_id'];
}
