@extends('template')

@section('titrePage')
    M2V - {{$nom}}
@endsection

@section('titreItem')
    <h1 class="text-center">{{$nom}}</h1>
@endsection

@section('contenu')
    <div class="w-25 mx-auto">
        <p class="text-center font-italic">{{$description}}</p>
    </div>
    @if (Session::get('alert'))
        <div class="alert alert-{!! Session::get('alert') !!}">
            {!! Session::get(Session::get('alert')) !!}
        </div>
    @endif
    @foreach($publications as $pub)
        <div class="card mx-auto w-50">
            <a class="card-header" href="{{route('publication.show', $pub)}}">{{$pub->titre}}</a>
            <div class="card-body">
                <p class="card-text">{{$pub->texte}}</p>
                <p><small class="card-text font-italic">Par {{$pub->auteurPublication->pseudo}}, le {{$pub->date_publication}}</small></p>
                <a href="#" class="btn btn-primary">Yeah ({{sizeof($pub->likes)}})</a>
                <a href="{{route('publication.show', $pub)}}" class="btn btn-secondary">Commenter ({{sizeof($pub->reponsesPublication)}})</a>
            </div>
        </div><br/>
    @endforeach
@endsection
