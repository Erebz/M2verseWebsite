<?php

namespace App\Http\Controllers;

use App\Modeles\Appartenance;
use App\Modeles\Communaute;
use App\Modeles\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommunauteController extends Controller
{
    public function addNewMember(Utilisateur $user, Communaute $com){
        if($user == null || $com == null){
            Session::flash("alert", "warning");
            Session::flash("warning", "An error occurred.");
            return redirect()->route('home')->send();;
        }else{
            $comUser = $user->communautes;
            if($comUser->contains($com)){
                Session::flash("alert", "warning");
                Session::flash("warning", "Error. You already joined this community.");
                return redirect()->route('communautes.show', $com->id)->send();
            }

            Appartenance::create([
                'communaute_id' => $com->id,
                'utilisateur_id' => $user->id,
            ]);
            Session::flash("alert", "success");
            Session::flash("success", "Yay! you joined " . $com->nom . "!");
            return redirect()->route('communautes.show', $com->id)->send();
        }
    }

    public function joinCom(Communaute $com){
        $user = Session::get('user');
        $this->addNewMember($user, $com);
    }

    public function removeMember(Utilisateur $user, Communaute $com){
        if($user == null || $com == null){
            Session::flash("alert", "warning");
            Session::flash("warning", "An error occurred.");
            return redirect()->route('home')->send();;
        }else{
            $comUser = $user->communautes;
            if(!$comUser->contains($com)){
                Session::flash("alert", "warning");
                Session::flash("warning", "Error. You already left " . $com->nom.".");
                return redirect()->route('home')->send();
            }

            $member = Appartenance::where('communaute_id', $com->id)->where('utilisateur_id', $user->id);
            $member->delete();

            Session::flash("alert", "success");
            Session::flash("success", "You left " . $com->nom . ".");
            return redirect()->route('home')->send();
        }
    }

    public function leaveCom(Communaute $com){
        $user = Session::get('user');
        $this->removeMember($user, $com);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communautes = Communaute::all();
        return view('listeCommunautes', compact('communautes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Communaute $communaute)
    {
        $nom = $communaute->nom;
        $description = $communaute->description;
        //TODO : trier publications par date
        $publications = $communaute->publications;
        $membres = $communaute->membres;

        return view('afficherCommunaute', compact('communaute', 'nom', 'description', 'publications', 'membres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
