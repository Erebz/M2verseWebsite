<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    {!! Html::style('lib/bootstrap/bootstrap.css') !!}

    <title>@yield('titrePage')</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">

        <a class="navbar-brand" href="{{url('/communautes')}}">M2verse</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/communautes')}}">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">
                        Voir...
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('/communautes')}}">Communautés</a>
                        <a class="dropdown-item" href="{{url('/utilisateurs')}}">Utilisateurs</a>
                    </div>
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
</footer>
{!! Html::script('lib/jquery/jquery-3.5.1.js') !!}
{!! Html::script('lib/js/bootstrap.bundle.js') !!}
{!! Html::script('lib/js/bootstrap.js/bootstrap.js') !!}
</body>
</html>
