@extends('template')

<script src="https://cdn.jsdelivr.net/npm/p5@1.1.9/lib/p5.js"></script>
{!! Html::script('js/m2vSketch2.js') !!}

@section('titrePage')
    M2V - {{$author->pseudo}} : {{$title}}
@endsection

@section('titreItem')
    <h1 class="text-center">{{$community->nom}}</h1><br/>
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
                @if(!$comment->likedByUser())
                    <button id="yeahButtonCom{{$comment->id}}" class="btn btn-outline-success" onclick="likeComment({{$comment->id}})">
                        <span id="yeahLabelCom{{$comment->id}}">Yeah</span>&nbsp<i class="far fa-thumbs-up" id="yeahIconCom{{$comment->id}}"></i>
                        (<span id="yeahCountCom{{$comment->id}}">{{sizeof($comment->likes)}}</span>)
                        <input id="routeLikeCom{{$comment->id}}" type="hidden" value="{{route('comment.like', $comment->id)}}">
                    </button>
                @else
                    <button id="yeahButtonCom{{$comment->id}}" class="btn btn-success" onclick="dislikeComment({{$comment->id}})">
                        <span id="yeahLabelCom{{$comment->id}}">Yeah!</span>&nbsp<i class="fas fa-thumbs-up" id="yeahIconCom{{$comment->id}}"></i>
                        (<span id="yeahCountCom{{$comment->id}}">{{sizeof($comment->likes)}}</span>)
                        <input id="routeLikeCom{{$comment->id}}" type="hidden" value="{{route('comment.like', $comment->id)}}">
                    </button>
                @endif
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
                        <a onclick="addDrawing()" id="btnAddDrawing" class="btn btn-outline-info" data-toggle="collapse" href="#drawingBox" role="button" aria-expanded="false" aria-controls="drawingBox">
                            <span id="labelAddDrawing">Add a drawing</span>&nbsp<i class="fas fa-pencil" id="iconAddDrawing"></i>
                            <input type="hidden" name="hasImage" id="addDrawing" value="false">
                            <input type="hidden" name="image" id="imageDataURL" value="null">
                        </a>
                        {!! Form::submit('Comment', ['class' => 'btn btn-info pull-right', 'id' => 'commentBtn']) !!}
                    </div>
                    <div class="container mx-auto collapse" id="drawingBox">
                        <br>
                        <div class="btn-toolbar p-1 mx-auto" role="toolbar" aria-label="Toolbar with button groups" id="toolbox">
                            <div class="btn-group mr-2" role="group" aria-label="reset">
                                <button id="btnClear" onclick="clearCanvas()" type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                            </div>
                            <div class="btn-group mr-4" role="group" aria-label="undo">
                                <button id="btnUndo" onclick="undo()" type="button" class="btn btn-outline-info"><i class="fas fa-undo-alt"></i></button>
                                <button id="btnRedo" onclick="redo()" type="button" class="btn btn-outline-info"><i class="fas fa-redo-alt"></i></button>
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="pencils">
                                <button id="btnPencil1" onclick="pencil(1)" type="button" class="btn btn-outline-secondary"><i class="fas fa-pencil-alt fa-sm"></i></button>
                                <button id="btnPencil2" onclick="pencil(2)" type="button" class="btn btn-outline-secondary"><i class="fas fa-pencil-alt fa-md"></i></button>
                                <button id="btnPencil3" onclick="pencil(3)" type="button" class="btn btn-outline-secondary"><i class="fas fa-pencil-alt fa-lg"></i></button>
                            </div>
                            <div class="btn-group mr-4" role="group" aria-label="erasers">
                                <button id="btnEraser1" onclick="eraser(1)" type="button" class="btn btn-outline-secondary"><i class="fas fa-eraser fa-sm"></i></button>
                                <button id="btnEraser2" onclick="eraser(2)" type="button" class="btn btn-outline-secondary"><i class="fas fa-eraser fa-md"></i></button>
                                <button id="btnEraser3" onclick="eraser(3)" type="button" class="btn btn-outline-secondary"><i class="fas fa-eraser fa-lg"></i></button>
                            </div>
                            <div class="btn-group" role="group" aria-label="color">
                                <button type="button" class="btn btn-outline-success"><i class="fas fa-palette"></i></button>
                            </div>
                        </div>
                        <div class="" id="canvas"></div>
                        <!--<div class="mx-auto text-center">
                            <button id="saveBtn" onclick="saveDrawing()" type="button" class="btn btn-success"><i class="fas fa-check"></i></button>
                        </div>-->
                    </div>
                    {!! Form::close() !!}
                </div>
            </div><br/>
        @endif
    </div>
@endsection
