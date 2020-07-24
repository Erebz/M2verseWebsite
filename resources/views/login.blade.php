@extends('template')

@section('titrePage')
    M2V - Log in
@endsection

@section('contenu')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-5 author font-weight-light">Enter M2verse</h1>
            <hr class="my-4">
            <div class="w-50 mx-auto text-center">
                <div class="card">
                    <p class="card-header display-5 author font-weight-light">Login</p>
                    @if (Session::get('alert'))
                        <div class="alert alert-{!! Session::get('alert') !!}">
                            {!! Session::get(Session::get('alert')) !!}
                        </div>
                    @endif
                    <div class="card-body">
                        {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
                        <div class="form-group {!! $errors->has('mail') ? 'has-error' : '' !!}">
                            {!! Form::email('mail', null, ['class' => 'form-control', 'placeholder' => 'Email...']) !!}
                            {!! $errors->first('mail', '<small class="help-block text-danger">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                            {{ Form::password('password', array('id' => 'password', "class" => "form-control", "placeholder" => "Password...")) }}
                            {!! $errors->first('password', '<small class="help-block text-danger">:message</small>') !!}
                        </div>
                        {!! Form::submit('Log in', ['class' => 'btn btn-info pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
