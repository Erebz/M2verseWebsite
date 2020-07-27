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
        <div class="alert alert-{!! Session::get('alert') !!} mx-auto w-50">
            {!! Session::get(Session::get('alert')) !!}
        </div>
    @endif
    @if($communaute->isUserMember())
        <div class="card mx-auto w-50">
            <div class="card-header text-center">
                <a class="btn btn-primary" data-toggle="collapse" href="#publishForm" role="button" aria-expanded="false" aria-controls="publishForm">
                    New post&nbsp<i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-body collapse" id="publishForm">
                {!! Form::open(['route' => ['communaute.publish', $communaute->id], 'method' => 'post']) !!}
                <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                    {!! $errors->first('title', '<small class="help-block text-danger">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('body') ? 'has-error' : '' !!}">
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Share something!', 'rows'=>'4']) !!}
                    {!! $errors->first('body', '<small class="help-block text-danger">:message</small>') !!}
                </div>
                <div class="text-center">
                    {!! Form::submit('Publish', ['class' => 'btn btn-info pull-right', 'id' => 'publishBtn']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div><br/>
    @else
        <div class="text-center">
            {!! Form::open(array('route' => array('communaute.join', $communaute->id), 'method' => 'post', 'class'=>'inlineElement')) !!}
            {!! Form::submit('Join this community', ['class' => 'btn btn-success inlineElement']) !!}
            {!! Form::close() !!}
        </div><br/>
    @endif
    @foreach($publications as $pub)
        <div class="card mx-auto w-50">
            <a class="card-header" href="{{route('publication.show', $pub)}}">{{$pub->titre}}</a>
            <div class="card-body">
                <p class="card-text">{{$pub->texte}}</p>
                <p><small class="card-text font-italic">Par {{$pub->auteurPublication->pseudo}}, le {{$pub->date_publication}}</small></p>
                @if(!$pub->likedByUser())
                    <button id="yeahButtonPub{{$pub->id}}" class="btn btn-success" onclick="likePublication({{$pub->id}})">
                        Yeah!
                        (<span id="yeahCountPub{{$pub->id}}">{{sizeof($pub->likes)}}</span>)
                        <input id="routeLikePub{{$pub->id}}" type="hidden" value="{{route('publication.like', $pub->id)}}">
                    </button>
                @else
                    <button id="yeahButtonPub{{$pub->id}}" class="btn btn-secondary" onclick="dislikePublication({{$pub->id}})">
                        Yeah!
                        (<span id="yeahCountPub{{$pub->id}}">{{sizeof($pub->likes)}}</span>)
                        <input id="routeLikePub{{$pub->id}}" type="hidden" value="{{route('publication.like', $pub->id)}}">
                    </button>
                @endif
                <a href="{{route('publication.show', $pub)}}" class="btn btn-secondary">Commenter ({{sizeof($pub->reponsesPublication)}})</a>
            </div>
        </div><br/>
    @endforeach
@endsection
