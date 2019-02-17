<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PumpMyKins</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/welcome.css', true) }}">
</head>
<body>



    <!-- Big screen font-->
   <div class="d-lg-block" id="content">
        <canvas id="canvas"></canvas>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/panel') }}">Panel</a>
                <a href="{{ url('/logout') }}">Se déconnecter</a>
                @else
                <a href="{{ route('login') }}">Connexion</a>
                
                @if (Route::has('register'))
                <a href="{{ route('register') }}">S'inscrire</a>
                @endif
                @endauth
            </div>
            @endif

            <div class="content">
                <div class="title">
                    <img class="img-fluid mx-auto imagepump" src="http://image.noelshack.com/fichiers/2018/52/1/1545668056-mainimage.png" width="10%">
                    PumpMyKins
                </div>
                <div class="links">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/servers') }}">Nos Serveurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/news') }}">Nouveautée(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/orgs/PumpMyKins/">GitHub</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://pumpmykins.buycraft.net/">Boutique</a>
                        </li>
                        <!--
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/legals') }}">Mentions Légales</a>
                        </li>
                        -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/welcomefont.js', true) }}"></script>
</body>
</html>
