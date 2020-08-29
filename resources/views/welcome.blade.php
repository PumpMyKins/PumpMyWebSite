<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PumpMyKins Renaissance</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Main Css import -->
    <link rel="stylesheet" href="{{  asset('/css/admin.css') }}">


    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .sticky-top button {
            border-radius: 0;
            border-bottom-right-radius: 0.25rem;
        }
        .body-dark {
            background-color: black;
        }
        .card {
            border-color: #fe8b18;
        }
        .card-dark {
            background-color: black;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
        .parent {
            overflow-y: scroll;
            scroll-behavior: smooth;
            max-height: 100%;
            scroll-snap-points-y: repeat(100vh);
            scroll-snap-type: y mandatory;
        }
        section {
            height: 100vh;
            color: rgba(white, .5);
            text-align: center;
            scroll-snap-align: start;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="sticky-top">
        <button type="button" class="btn btn-outline-danger" onclick="lights()">
            <i class="ti-light-bulb"></i>
            <span id="lights-indicator">Eteindre la lumière</span>
        </button>
    </div>
    <div class="parent">
        <section id="part-1" class="d-flex justify-content-center align-items-center position-ref">
            <div class="content">
                <img class="" src="{{ asset('images/logo-medium.png') }}" alt="logo-pmk">
                <div class="title m-b-md">
                    PumpMyKins
                </div>

                <div class="links">
                    <a href="{{ route('panel') }}">Panel</a>
                    <a href="{{ route('panel.servers')}}">{{ __('Servers') }}</a>
                    <a href="{{ route('panel.infos') }}">{{ __('Informations') }}</a>
                    <a href="">{{ __('Shop') }}</a>
                    <a href="https://github.com/pumpmykins">{{ __('Our Github') }}</a>
                </div>
                <br>
                <a href="#part-2">
                    <i style="font-size: 64px; color: #fe8b18;" class="fa fa-arrow-circle-down"></i>
                </a>
            </div>
        </section>
        <section id="part-2" class="d-flex justify-content-center align-items-center position-ref ">
            <div class="content">
                <a href="#part-1">
                    <i style="font-size: 64px; color: #fe8b18;" class="fa fa-arrow-circle-up"></i>
                </a>
                <div class="title m-b-md">
                    Informations
                </div>
                <div id="carousel-information" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-information" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-information" data-slide-to="1"></li>
                        <li data-target="#carousel-information" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="100vw" height="400px" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#ff8b18" fill-opacity="0.4"></rect></svg>
                            <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="100vw" height="400px" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#ff8b18" fill-opacity="0.4"></rect></svg>
                            <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="100vw" height="400px" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#ff8b18" fill-opacity="0.4"></rect></svg>
                            <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-information" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-information" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <br>
                <a href="#part-3">
                    <i style="font-size: 64px; color: #fe8b18;" class="fa fa-arrow-circle-down"></i>
                </a>
            </div>
        </section>
        <section id="part-3" class="d-flex justify-content-center align-items-center position-ref ">
            <div class="content">
                <a href="#part-2">
                    <i style="font-size: 64px; color: #fe8b18;" class="fa fa-arrow-circle-up"></i>
                </a>
                <br>
                <div class="title m-b-md">
                    Association
                </div>
                <div class="card" style="width: 60vw; height: 20vh;">
                    <div class="card-body">
                        <h5 class="card-title">PumpMyKins</h5>
                        <p class="card-text">
                            PumpMyKins, au délà des serveurs minecraft que nous proposons, nous sommes une association ayant pour objectif de divertire la jeunesse et de soutenir l'OpenSource. Nous nous plaçons comme une association ayant des valeurs simple et forte, le respect et l'honneteter envers ses membres
                        </p>
                  </div>
                </div>
                <br>
                <a href="#part-4">
                    <i style="font-size: 64px; color: #fe8b18;" class="fa fa-arrow-circle-down"></i>
                </a>
            </div>
        </section>
        <section id="part-4" class="d-flex justify-content-center align-items-center position-ref ">
            <div class="content">
                <a href="#part-3">
                    <i style="font-size: 64px; color: #fe8b18;" class="fa fa-arrow-circle-up"></i>
                </a>
                <br>
                <div class="title m-b-md">
                    Nos Projets
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card " style="width: 30vw; height: 20vh;">
                            <div class="card-body">
                                <h5 class="card-title">PumpMyKins Renaissance</h5>
                                <p class="card-text">
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card " style="width: 30vw; height: 20vh;">
                            <div class="card-body">
                                <h5 class="card-title">PumpMyKins Server</h5>
                                <p class="card-text">
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card " style="width: 30vw; height: 20vh;">
                            <div class="card-body">
                                <h5 class="card-title">PumpMyKins Eco</h5>
                                <p class="card-text">
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card " style="width: 30vw; height: 20vh;">
                            <div class="card-body">
                                <h5 class="card-title">PumpMyKins Website</h5>
                                <p class="card-text">
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </section>
    </div>
    <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>
    <script type="text/javascript">
        const card_list = document.getElementsByClassName('card')
        const eteindre = "Eteindre la lumière";
        const allumer = "Allumer la lumière";
        function lights() {
            document.getElementsByTagName('body')[0].classList.toggle('body-dark')
            if (document.getElementById('lights-indicator').innerHTML == eteindre) {
                document.getElementById('lights-indicator').innerHTML = allumer;
            } else {
                document.getElementById('lights-indicator').innerHTML = eteindre;
            }
            for (item of card_list) {
                item.classList.toggle('card-dark')
            }
        }
    </script>
</body>
</html>
