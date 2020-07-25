<?php

namespace App\Modeles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    public $timestamps = false;
    protected $fillable = ['nom', 'pseudo', 'mail', 'password', 'anniversaire'];
    //protected $primaryKey = 'id';
    protected $hidden = ['password'];

    public function publications(){
        return $this->hasMany(Publication::class, 'auteur', 'id');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'auteur', 'id');
    }

    public function getCommunautesAttribute(){
        return $this->belongsToMany(Communaute::class, 'appartenances', 'utilisateur_id', 'communaute_id')->get();
    }

    /*
    public function amis(){
        return $this->belongsToMany(Utilisateur::class, 'amis', 'ami1', 'ami2');
    }
    */

    //Amitié user1 -> user2
    public function amiAvec(){
        return $this->belongsToMany(Utilisateur::class, 'amis', 'ami1', 'ami2');
    }

    //Amitié user2 -> user1
    public function amiDe(){
        return $this->belongsToMany(Utilisateur::class, 'amis', 'ami2', 'ami1');
    }

    public function getAmisAttribute()
    {
        if ( ! array_key_exists('amis', $this->relations)) $this->loadAmis();
        //dd($this->getRelation('amis'));
        return $this->getRelation('amis');
    }

    protected function loadAmis()
    {
        if ( ! array_key_exists('amis', $this->relations))
        {
            $amis = $this->mergeAmis();

            $this->setRelation('amis', $amis);
        }
    }

    protected function mergeAmis()
    {
        return $this->amiAvec->merge($this->amiDe);
    }

    public function getLikedPublicationsAttribute(){
        return $this->belongsToMany(Publication::class, 'likes', 'utilisateur_id', 'publication_id');
    }

    public function isMemberOf(Communaute $com){
        return ($this->communautes->contains($com));
    }

    //public function setPasswordAttribute($password)
    //{
        //$this->attributes['password'] = Hash::make($password);
    //}

    /*
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
    */
}
