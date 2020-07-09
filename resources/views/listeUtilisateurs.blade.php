@extends('template')

@section('titrePage')
    Liste des Utilisateurs
@endsection

@section('titreItem')
    <h1>Tous les utilisateurs :</h1>
@endsection

@section('contenu')
    @foreach($utilisateurs as $user)
        <p>Nom : {{$user->nom}}</p>
        <p>Pseudo : {{$user->pseudo}}</p>
        <p>Amis : {{$user->amis}}</p>
        <p>Communautés : {{$user->communautes}}</p>
        <p>Publications : {{$user->publications}}</p>
        <p>Messages : {{$user->messages}}</p>
    @endforeach
@endsection
