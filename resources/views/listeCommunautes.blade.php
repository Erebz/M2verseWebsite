@extends('template')

@section('titrePage')
    M2V - Communities
@endsection

@section('titreItem')
    <h1>Communities</h1>
@endsection

@section('contenu')
    @foreach($communautes as $com)
        <div class="card">
            <h5 class="card-header">{{$com->nom}}</h5>
            <div class="card-body">
                <p class="card-text">{{$com->description}}</p>
                <p class="card-text">Nombres de membres : {{sizeof($com->membres)}}</p>
                <p class="card-text">Nombres de publications : {{sizeof($com->publications)}}</p>
                <a href="{{ route('communautes.show', $com->id) }}" class="btn btn-primary">Explore</a>
                {!! Form::open(array('route' => array('communaute.join', $com->id), 'method' => 'post', 'class'=>'inlineElement')) !!}
                {!! Form::submit('Join', ['class' => 'btn btn-secondary inlineElement']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
@endsection
