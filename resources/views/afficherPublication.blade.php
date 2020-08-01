@extends('template')

<script src="https://cdn.jsdelivr.net/npm/p5@1.1.9/lib/p5.js"></script>
{!! Html::script('js/m2vSketch2.js') !!}

@section('titrePage')
    M2V - {{$author->pseudo}} : {{$title}}
@endsection

@section('titreItem')
    <h1 class="text-center">{{$community->nom}}</h1>
    <div class="mx-auto text-center">
        <a class="btn btn-outline-info text-center" href="{{route('communautes.show', $community->id)}}">Back</a>
    </div><br/>
@endsection

@section('contenu')
    <div class="container">
        <div class="card mx-auto w-75 mt-lg-2">
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
            @if($publication->titre)
                <h5 class="card-title">{{$publication->titre ?? ''}}</h5>
            @endif
            @if($publication->texte)
                <p class="card-text">{{$publication->texte}}</p>
            @endif
            @if($publication->image != null)
                <div class="boxPost mx-auto">
                    <img class="imagePost" src={{url('storage/'.$publication->image)}}>
                </div>
            @endif
            <p><small class="card-text font-italic">Posted on {{$date}}</small></p>
            @component('components.yeahPostBtn', ['publication' => $publication])@endcomponent
        </div>
    </div><br/>
    <hr class="my-4">
    <h4 class="text-center">Comments ({{sizeof($comments)}})</h4><br/>
    @foreach($comments as $comment)
        <div class="card mx-auto w-75">
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
                        <img class="imagePost" src={{url('storage/'.$comment->image)}}>
                    </div>
                @endif
                <p><small class="card-text font-italic">Posted on {{$comment->date_message}}</small></p>
                @component('components.yeahCommentBtn', ['comment' => $comment])
                @endcomponent
            </div>
        </div><br/>
    @endforeach
        @if($community->isUserMember())
            <div class="card mx-auto w-75">
                <div class="card-header text-center">
                    <a class="btn btn-primary" data-toggle="collapse" href="#commentForm" role="button" aria-expanded="false" aria-controls="commentForm">
                        Post a comment&nbsp<i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body collapse" id="commentForm">
                    {!! Form::open(['route' => ['publication.comment', $publication->id], 'method' => 'post', 'id'=>'commentForm', 'onsubmit' => 'return checkForm();']) !!}
                    <div class="form-group {!! $errors->has('body') ? 'has-error' : '' !!}">
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Say something!', 'rows'=>'4', 'id'=>'bodyInput']) !!}
                        {!! $errors->first('body', '<small class="help-block text-danger">:message</small>') !!}
                    </div>
                    <div class="text-center">
                        @component('components.addDrawing')
                        @endcomponent
                        {!! Form::submit('Comment', ['class' => 'btn btn-info pull-right', 'id' => 'commentBtn']) !!}
                    </div>
                    @component('components.drawingCanvas')
                    @endcomponent
                    {!! Form::close() !!}
                </div>
            </div><br/>
        @endif
    </div>
@endsection


