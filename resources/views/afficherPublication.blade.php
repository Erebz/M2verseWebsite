@extends('template')

@section('titrePage')
    M2V - {{$author->pseudo}} : {{$title}}
@endsection

@section('titreItem')
    <h1 class="text-center">{{$community->nom}}</h1><br/>
@endsection

@section('contenu')
    <div class="container">
        <div class="card mx-auto w-50 mt-lg-2">
        <div class="card-header">
            <div class="row">
            <div class="card col-3">
                <p class="text-center">[MII]</p>
            </div>
            <div class="col-auto">
                <a class="text-center" href="#">{{$author->pseudo}}</a>
            </div>
            </div>
        </div>

        <div class="card-body">
            <h5 class="card-title">{{$title}}</h5>
            <p class="card-text">{{$body}}</p>
            <p><small class="card-text font-italic">Posted on {{$date}}</small></p>
            @if(!$publication->likedByUser())
                <button id="yeahButtonPub{{$publication->id}}" class="btn btn-success" onclick="likePublication({{$publication->id}})">
                    Yeah!
                    (<span id="yeahCountPub{{$publication->id}}">{{sizeof($publication->likes)}}</span>)
                    <input id="routeLikePub{{$publication->id}}" type="hidden" value="{{route('publication.like', $publication->id)}}">
                </button>
            @else
                <button id="yeahButtonPub{{$publication->id}}" class="btn btn-secondary" onclick="dislikePublication({{$publication->id}})">
                    Yeah!
                    (<span id="yeahCountPub{{$publication->id}}">{{sizeof($publication->likes)}}</span>)
                    <input id="routeLikePub{{$publication->id}}" type="hidden" value="{{route('publication.like', $publication->id)}}">
                </button>
            @endif
        </div>
    </div><br/>
    <hr class="my-4">
    <h4 class="text-center">Comments ({{sizeof($comments)}})</h4>
        @if($community->isUserMember())
            <div class="card mx-auto w-50">
                <div class="card-header text-center">
                    <a class="btn btn-primary" data-toggle="collapse" href="#commentForm" role="button" aria-expanded="false" aria-controls="commentForm">
                        Post a comment&nbsp<i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body collapse" id="commentForm">
                    {!! Form::open(['route' => ['publication.comment', $publication->id], 'method' => 'post']) !!}
                    <div class="form-group {!! $errors->has('body') ? 'has-error' : '' !!}">
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Say something!', 'rows'=>'4']) !!}
                        {!! $errors->first('body', '<small class="help-block text-danger">:message</small>') !!}
                    </div>
                    <div class="text-center">
                        {!! Form::submit('Comment', ['class' => 'btn btn-info pull-right', 'id' => 'commentBtn']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div><br/>
        @endif
    @foreach($comments as $comment)
        <div class="card mx-auto w-50">
            <div class="card-header">
                <div class="row">
                    <div class="card col-3">
                        <p class="text-center">[MII]</p>
                    </div>
                    <div class="col-auto">
                        <a class="text-center" href="#">{{$author->pseudo}}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{$comment->texte}}</p>
                <p><small class="card-text font-italic">Posted on {{$comment->date_message}}</small></p>
                @if(!$comment->likedByUser())
                    <button id="yeahButtonCom{{$comment->id}}" class="btn btn-success" onclick="likeComment({{$comment->id}})">
                        Yeah!
                        (<span id="yeahCountCom{{$comment->id}}">{{sizeof($comment->likes)}}</span>)
                        <input id="routeLikeCom{{$comment->id}}" type="hidden" value="{{route('comment.like', $comment->id)}}">
                    </button>
                @else
                    <button id="yeahButtonCom{{$comment->id}}" class="btn btn-secondary" onclick="dislikeComment({{$comment->id}})">
                        Yeah!
                        (<span id="yeahCountCom{{$comment->id}}">{{sizeof($comment->likes)}}</span>)
                        <input id="routeLikeCom{{$comment->id}}" type="hidden" value="{{route('comment.like', $comment->id)}}">
                    </button>
                @endif
            </div>
        </div><br/>
    @endforeach
    </div>
@endsection
