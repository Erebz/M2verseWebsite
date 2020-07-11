@extends('template')

@section('titrePage')
    M2V - {{$nom}}
@endsection

@section('titreItem')
    <h1>{{$nom}}</h1>
@endsection

@section('contenu')
    <p>{{$description}}</p>
    @foreach($publications as $pub)
        <div class="card">
            <h5 class="card-header">{{$pub->titre}}</h5>
            <div class="card-body">
                <p class="card-text">{{$pub->texte}}</p>
                <p><small class="card-text font-italic">Par {{$pub->auteurPublication->pseudo}}, le {{$pub->date_publication}}</small></p>
                <a href="#" class="btn btn-primary">Yeah ({{sizeof($pub->likes)}})</a>
                <a href="#" class="btn btn-secondary">Commenter ({{sizeof($pub->reponsesPublication)}})</a>
            </div>
        </div>
    @endforeach
@endsection
