<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! Html::script('lib/jquery/jquery-3.5.1.js') !!}
    {!! Html::script('lib/js/bootstrap.bundle.js') !!}
    {!! Html::script('lib/js/bootstrap.js') !!}
    {!! Html::script('js/fonctions.js') !!}
    {!! Html::style('lib/bootstrap/bootstrap.css') !!}
    {!! Html::style('css/styleGlobal.css') !!}
    <link rel="stylesheet" type="text/css" href="{{url('lib/fontawesome/css/all.css')}}" media="screen,projection"/>
    {{ Html::favicon('img/favicon.png') }}
    <script src="http://unpkg.com/turbolinks"></script>

    <title>@yield('titrePage')</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">

        <a class="navbar-brand" href="{{url('/')}}">M2verse</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @auth()
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">
                            {{Session::get('user')->pseudo}}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('home')}}">Home</a>
                            <a class="dropdown-item" href="{{route('home')}}">Profile</a>
                            {!! Form::open(['method' => 'post', 'route' => 'logout', 'class' => 'dropdown-item inlineElement']) !!}
                            {!! Form::submit('Logout') !!}
                            {!! Form::close() !!}
                        </div>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">
                            Browse...
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('/communautes')}}">Communities</a>
                            <a class="dropdown-item" href="{{url('/utilisateurs')}}">Users</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('login')}}"> Login
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('register')}}"> Register
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/info')}}">About us
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/users/Erebz/projects/1">Github</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<header>
    <h1>@yield('titreItem')</h1>
</header>

@yield('contenu')

<footer class="footer">
    <p>M2verse - 2020 - Erebz</p>
    <p></p>
</footer>
</body>
</html>
