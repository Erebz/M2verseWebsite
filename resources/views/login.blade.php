@extends('template')

@section('contenu')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3">M2verse.</h1>
            <p class="lead">Create. Share. Like never before.</p>
            <hr class="my-4">
            <h1 class="display-5 author font-weight-light">Login</h1>
            <div class="col-sm-offset-3 col-sm-6">
                <div class="card">
                    <p class="card-header display-5 author font-weight-light">Login</p>
                    <div class="card-body">
                        {!! Form::open(['action' => 'LoginController@authenticate']) !!}
                        <div class="form-group {!! $errors->has('mail') ? 'has-error' : '' !!}">
                            {!! Form::email('mail', null, ['class' => 'form-control', 'placeholder' => 'Email...']) !!}
                            {!! $errors->first('mail', '<small class="help-block text-danger">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                            {!! Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Password...']) !!}
                            {!! $errors->first('password', '<small class="help-block text-danger">:message</small>') !!}
                        </div>
                        {!! Form::submit('Login', ['class' => 'btn btn-info pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
