@extends('template')

@section('contenu')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-5 author font-weight-light">Join M2verse</h1>
            <hr class="my-4">
            <div class="w-50 mx-auto text-center">
                <div class="card">
                    <p class="card-header display-5 author font-weight-light">Register</p>
                    @if (Session::get('alert'))
                        <div class="alert alert-{!! Session::get('alert') !!}">
                            {!! Session::get(Session::get('alert')) !!}
                        </div>
                    @endif
                    <div class="card-body">
                        {!! Form::open(['route' => 'register', 'method' => 'post']) !!}
                        <div class="form-group {!! $errors->has('pseudo') ? 'has-error' : '' !!}">
                            {!! Form::text('pseudo', null, ['class' => 'form-control', 'placeholder' => 'Username...']) !!}
                            {!! $errors->first('pseudo', '<small class="help-block text-danger">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('nom') ? 'has-error' : '' !!}">
                            {!! Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Name...']) !!}
                            {!! $errors->first('nom', '<small class="help-block text-danger">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('mail') ? 'has-error' : '' !!}">
                            {!! Form::email('mail', null, ['class' => 'form-control', 'placeholder' => 'Email...']) !!}
                            {!! $errors->first('mail', '<small class="help-block text-danger">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                            {!! Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Password...']) !!}
                            {!! $errors->first('password', '<small class="help-block text-danger">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('anniversaire') ? 'has-error' : '' !!}">
                            {!! Form::date('anniversaire', null, ['class' => 'form-control', 'placeholder' => 'Birthday...']) !!}
                            {!! $errors->first('anniversaire', '<small class="help-block text-danger">:message</small>') !!}
                        </div>
                        {!! Form::submit('Register', ['class' => 'btn btn-info pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
