@extends('template')

@section('titrePage')
    M2V - Communities
@endsection

@section('titreItem')
    <h1 class="text-center">Communities</h1>
@endsection

@section('contenu')
    @foreach($communautes as $com)
        <div class="card w-50 mx-auto">
            <h5 class="card-header">{{$com->nom}}</h5>
            <div class="card-body">
                <p class="card-text">{{$com->description}}</p>
                <p class="card-text">{{$nb = sizeof($com->membres)}} member{{$nb>1?'s':''}}</p>
                <p class="card-text">{{$nb = sizeof($com->publications)}} publication{{$nb>1?'s':''}}</p>
                <a href="{{ route('communautes.show', $com->id) }}" class="btn btn-primary">Explore</a>
                @if(!Session::get('user')->isMemberOf($com))
                    {!! Form::open(array('route' => array('communaute.join', $com->id), 'method' => 'post', 'class'=>'inlineElement')) !!}
                    {!! Form::submit('Join', ['class' => 'btn btn-success inlineElement']) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(array('route' => array('communaute.leave', $com->id), 'method' => 'post', 'class'=>'inlineElement')) !!}
                    {!! Form::submit('Leave', ['class' => 'btn btn-danger inlineElement']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
        </div><br/>
    @endforeach
@endsection
