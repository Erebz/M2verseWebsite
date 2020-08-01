@extends('template')

@section('titrePage')
    M2V - About us
@endsection

@section('contenu')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
        <h1 class="display-3">M2verse.</h1>
        <p class="lead">Create. Share. Like never before.</p>
        <hr class="my-4">
            <h1 class="display-5 author font-weight-light">Staff</h1>
            <div class="row">
                <div class="col-6 boxAuthor">
                    <p class="text-center font-weight-light">Jennie - dev back-end</p>
                    <img class="imageAuthor" src="img/jennie1.jpg"/>
                </div>
                <div class="col-6 boxAuthor">
                    <p class="text-center font-weight-light">Lisa - dev front-end</p>
                    <img class="imageAuthor" src="img/lisa1.jpg"/>
                </div>
            </div>
        </div>
    </div>
@endsection
