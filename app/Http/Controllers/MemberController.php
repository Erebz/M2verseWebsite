<?php

namespace App\Http\Controllers;

use App\Modeles\Appartenance;
use App\Modeles\Communaute;
use App\Modeles\Utilisateur;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function createNewMember(Utilisateur $user, Communaute $com){
        if($user == null || $com == null){
            Session::flash("alert", "warning");
            Session::flash("warning", "Error. Couldn't join the community.");
            return route('home');
        }else{
            Appartenance::create([
                'community_id' => $com->id,
                'user_id' => $user->id,
            ]);
            Session::flash("alert", "success");
            Session::flash("success", "Yay! you joined " . $com->nom . "!");
            return route('communautes.show', $com->id);
        }
    }

    public function join(Communaute $com){
        $user = Session::get('user');
        $this->createNewMember($user, $com);
        dd("OK");
    }
}
