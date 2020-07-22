@extends('template')

@section('titrePage')
    Liste des Utilisateurs
@endsection

@section('titreItem')
    <h1>Tous les utilisateurs :</h1>
@endsection

@section('contenu')
    <h3>Utilisateurs : </h3>
    @foreach($utilisateurs as $user)
        <h5>Nom : {{$user->nom}}</h5>
        <p>Pseudo : {{$user->pseudo}}</p>
        <p>Amis : </p>
        <ul>
            @foreach($user->amis as $ami)
                <li><p>{{$ami->nom}}</p></li>
            @endforeach
        </ul>
        <p>Communautés : </p>
        <ul>
            @foreach($user->communautes as $com)
                <li><p>{{$com->nom}}</p></li>
            @endforeach
        </ul>
        <p>Publications : {{sizeof($user->publications)}}</p>
        <p>Messages : {{sizeof($user->messages)}}</p>
    @endforeach
    <h3>Communautés : </h3>
    @foreach($communautes as $com)
        <div class="card">
            <h5 class="card-header">{{$com->nom}}</h5>
            <div class="card-body">
                <p class="card-text">{{$com->description}}</p>
            </div>
        </div>
    @endforeach
    <h3>Publications : </h3>
    @foreach($publications as $pub)
        <h5>Titre : {{$pub->titre}}</h5>
        <p>Auteur : {{$pub->auteurPublication->nom ?? ''}}</p>
        <p>Texte : {{$pub->texte}}</p>
        <p>Image : {{$pub->image}}</p>
        <p>Posté dans : {{$pub->communautePublication->nom}}</p>
        <p>Date : {{$pub->date_publication}}</p>
    @endforeach
    <h3>Commentaires : </h3>
    @foreach($messages as $mes)
        <div class="card">
            <h5 class="card-header">{{$com->nom}}</h5>
            <div class="card-body">
                <p class="card-text">Auteur : {{$mes->auteurMessage->nom ?? ''}}</p>
                <p class="card-text">Texte : {{$mes->texte}}</p>
                <p class="card-text">Image : {{$mes->image}}</p>
                <p class="card-text">Réponse à : {{$mes->publicationOrigine->titre}}</p>
                <p class="card-text">Date : {{$mes->date_message}}</p>
            </div>
        </div>
    @endforeach
@endsection
