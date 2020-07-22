<?php

namespace App\Modeles;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Utilisateur extends Model implements Authenticatable, AuthenticateContract
{
    use \Illuminate\Auth\Authenticatable;

    public $timestamps = false;
    protected $fillable = ['nom', 'pseudo', 'mail', 'password', 'anniversaire'];
    protected $hidden = ['password'];

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

    public function likedPublications(){
        return $this->belongsToMany(Publication::class, 'likes');
    }

    //public function setPasswordAttribute($password)
    //{
        //$this->attributes['password'] = Hash::make($password);
    //}


    //Authentification :
    public function getKeyName()
    {
        return 'mail';
    }
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function getRememberToken()
    {
        if (! empty($this->getRememberTokenName())) {
            return (string) $this->{$this->getRememberTokenName()};
        }
    }
    public function setRememberToken($value)
    {
        if (! empty($this->getRememberTokenName())) {
            $this->{$this->getRememberTokenName()} = $value;
        }
    }
    public function getRememberTokenName()
    {
        return $this->rememberTokenName;
    }
}
