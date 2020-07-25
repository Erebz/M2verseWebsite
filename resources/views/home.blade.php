@extends('template')

@section('titrePage')
    M2V - Home
@endsection

@section('contenu')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3">Welcome, {!! $user->pseudo !!}</h1>
            <p class="lead">What will you share today?</p>
            <hr class="my-4">
            <h1 class="display-5 author font-weight-light">Your communities</h1>
            <div class="row">
                <div class="mx-auto">
                    @if (Session::get('alert'))
                        <div class="alert alert-{!! Session::get('alert') !!}">
                            {!! Session::get(Session::get('alert')) !!}
                        </div>
                    @endif
                    @if(sizeof($communities) > 0)
                        @foreach($communities as $com)
                            <div class="card">
                                <h5 class="card-header">{{$com->nom}}</h5>
                                <div class="card-body">
                                    <p class="card-text">{{$com->description}}</p>
                                    <div class="text-center">
                                        <a href="{{ route('communautes.show', $com->id) }}" class="btn btn-primary">Explore</a>
                                        {!! Form::open(array('route' => array('communaute.leave', $com->id), 'method' => 'post', 'class' => 'inlineElement')) !!}
                                        {!! Form::submit('Leave', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div><br/>
                        @endforeach
                            <div class="text-center">
                                <a href="{{ route('communautes.index') }}" class="btn btn-primary">Browse Communities</a>
                            </div>
                    @else
                        <p class="lead centerText">You didn't join any community.</p>
                        <div class="text-center">
                            <a href="{{ route('communautes.index') }}" class="btn btn-primary">Find one!</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
