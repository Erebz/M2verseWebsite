@extends('template')

@section('titrePage')
    M2V - {{$nom}}
@endsection
<script src="https://cdn.jsdelivr.net/npm/p5@1.1.9/lib/p5.js"></script>
{!! Html::script('js/m2vSketch.js') !!}

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
                    <a class="btn btn-outline-info" data-toggle="collapse" href="#drawingBox" role="button" aria-expanded="false" aria-controls="drawingBox">
                        Add a drawing&nbsp<i class="fas fa-pencil"></i>
                    </a>
                    {!! Form::submit('Publish', ['class' => 'btn btn-info pull-right', 'id' => 'publishBtn']) !!}
                </div>
                <div class="container mx-auto collapse" id="drawingBox">
                    <br>
                    <div class="btn-toolbar p-1 mx-auto" role="toolbar" aria-label="Toolbar with button groups" id="toolbox">
                        <div class="btn-group mr-2" role="group" aria-label="reset">
                            <button id="btnClear" onclick="clearCanvas()" type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                        </div>
                        <div class="btn-group mr-4" role="group" aria-label="undo">
                            <button id="btnUndo" onclick="undo()" type="button" class="btn btn-outline-info"><i class="fas fa-undo-alt"></i></button>
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
    @foreach($publications as $publication)
        <div class="card mx-auto w-50">
            <div class="card-header">
                <div class="row">
                    <div class="boxProfile small card">
                        <img class="imageProfile" src={{url('img/mii_basic.png')}}>
                    </div>
                    <div class="col-auto mt-3">
                        <a class="text-center" href="{{route('publication.show', $publication)}}">{{$publication->auteurPublication->pseudo}}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($publication->titre)
                    <h5 class="card-title">{{$publication->titre ?? ''}}</h5>
                @endif
                <p class="card-text">{{$publication->texte}}</p>
                <p><small class="card-text font-italic">Par {{$publication->auteurPublication->pseudo}}, le {{$publication->date_publication}}</small></p>
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
                <a href="{{route('publication.show', $publication)}}" class="btn btn-secondary">Commenter ({{sizeof($publication->reponsesPublication)}})</a>
            </div>
        </div><br/>
    @endforeach
@endsection
