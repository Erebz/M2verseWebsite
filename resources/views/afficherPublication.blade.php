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
            <a href="#" class="btn btn-success">Yeah! ({{sizeof($publication->likes)}})</a>
        </div>
    </div><br/>
    <hr class="my-4">
    <h4 class="text-center">Comments ({{sizeof($comments)}})</h4>
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
                <a href="#" class="btn btn-success">Yeah!</a>
            </div>
        </div><br/>
    @endforeach
    </div>
@endsection
