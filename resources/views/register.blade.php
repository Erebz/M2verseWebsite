@extends('template')

@section('contenu')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3">M2verse.</h1>
            <p class="lead">Create. Share. Like never before.</p>
            <hr class="my-4">
            <h1 class="display-5 author font-weight-light">Register</h1>
            <div class="col-sm-offset-3 col-sm-6">
                <div class="card">
                    <p class="card-header display-5 author font-weight-light">Register</p>
                    <div class="card-body">
                        {!! Form::open(['action' => 'RegistrationController@register']) !!}
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
