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
            <div class="boxProfile small card">
                <img class="imageProfile" src={{url('img/mii_basic.png')}}>
            </div>
            <div class="col-auto mt-3">
                <a class="text-center" href="#">{{$author->pseudo}}</a>
            </div>
            </div>
        </div>

        <div class="card-body">
            @if($title)
                <h5 class="card-title">{{$title ?? ''}}</h5>
            @endif
            <p class="card-text">{{$body}}</p>
            <p><small class="card-text font-italic">Posted on {{$date}}</small></p>
            @if(!$publication->likedByUser())
                <button id="yeahButtonPub{{$publication->id}}" class="btn btn-outline-success" onclick="likePublication({{$publication->id}})">
                    <span id="yeahLabelPub{{$publication->id}}">Yeah</span>&nbsp<i class="far fa-thumbs-up" id="yeahIconPub{{$publication->id}}"></i>
                    (<span id="yeahCountPub{{$publication->id}}">{{sizeof($publication->likes)}}</span>)
                    <input id="routeLikePub{{$publication->id}}" type="hidden" value="{{route('publication.like', $publication->id)}}">
                </button>
            @else
                <button id="yeahButtonPub{{$publication->id}}" class="btn btn-success" onclick="dislikePublication({{$publication->id}})">
                    <span id="yeahLabelPub{{$publication->id}}">Yeah!</span>&nbsp<i class="fas fa-thumbs-up" id="yeahIconPub{{$publication->id}}"></i>
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
                    {!! Form::open(['route' => ['publication.comment', $publication->id], 'method' => 'post', 'id'=>'commentForm']) !!}
                    <div class="form-group {!! $errors->has('body') ? 'has-error' : '' !!}">
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Say something!', 'rows'=>'4', 'id'=>'commentText', 'oninput' => 'checkCommentForm()']) !!}
                        {!! $errors->first('body', '<small class="help-block text-danger">:message</small>') !!}
                    </div>
                    <div class="text-center">
                        {!! Form::submit('Comment', ['class' => 'btn btn-info pull-right', 'id' => 'commentBtn', 'disabled' => 'true']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div><br/>
        @endif
    @foreach($comments as $comment)
        <div class="card mx-auto w-50">
            <div class="card-header">
                <div class="row">
                    <div class="boxProfile small card">
                        <img class="imageProfile" src={{url('img/mii_basic.png')}}>
                    </div>
                    <div class="col-auto mt-3">
                        <a class="text-center" href="#">{{$comment->auteurMessage->pseudo}}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{$comment->texte}}</p>
                @if($comment->image != null)
                    <div class="boxPost mx-auto">
                        <img class="imagePost" src={{url('img/wide.jpg')}}>
                    </div>
                @endif
                <p><small class="card-text font-italic">Posted on {{$comment->date_message}}</small></p>
                @if(!$comment->likedByUser())
                    <button id="yeahButtonCom{{$comment->id}}" class="btn btn-outline-success" onclick="likeComment({{$comment->id}})">
                        <span id="yeahLabelCom{{$comment->id}}">Yeah</span>&nbsp<i class="far fa-thumbs-up" id="yeahIconCom{{$comment->id}}"></i>
                        (<span id="yeahCountCom{{$comment->id}}">{{sizeof($comment->likes)}}</span>)
                        <input id="routeLikeCom{{$comment->id}}" type="hidden" value="{{route('comment.like', $comment->id)}}">
                    </button>
                @else
                    <button id="yeahButtonCom{{$comment->id}}" class="btn btn-success" onclick="dislikeComment({{$comment->id}})">
                        <span id="yeahLabelCom{{$comment->id}}">Yeah</span>&nbsp<i class="fas fa-thumbs-up" id="yeahIconCom{{$comment->id}}"></i>
                        (<span id="yeahCountCom{{$comment->id}}">{{sizeof($comment->likes)}}</span>)
                        <input id="routeLikeCom{{$comment->id}}" type="hidden" value="{{route('comment.like', $comment->id)}}">
                    </button>
                @endif
            </div>
        </div><br/>
    @endforeach
    </div>
@endsection
