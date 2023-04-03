<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Clon Instagram</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    {{-- <link href="{{ asset('resources/sass/app.scss') }}" rel="stylesheet"> --}}
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito';
            background: #eee;
           
        }

        .contenedor {
            width: 90%;
            height: 650px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .columna {
            width: 600px;
        }

        .contenedor-imagen {
            display: flex;
            flex-direction: row;
            justify-content: end;
            position: relative;
        }
        .arriba{
            position: absolute;
            left: 210px;
            z-index: -1;
            bottom: 20px;
        }
        .border-imagen {
            height: 550px;
            border: 15px solid #000;
            border-radius: 40px;
        }
        .borde-celular{
            height: 100%;
        }
        .contenedor-login {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tarjeta {
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, .3);
        }

        .user-logo {
            width: 250px;
            margin-bottom: 10px;
        }

        .botones {
            text-align: center;
        }
        @media screen and (max-width: 1086px){
            .contenedor-imagen{
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <div class="contenedor-imagen columna">
            <div class="border-imagen arriba">
                <img class="borde-celular"
                    src="https://www.instagram.com/static/images/homepage/screenshots/screenshot2.png/4d62acb667fb.png"
                    alt="fondo_imagen">
            </div>
            <div class="border-imagen ">
                <img class="borde-celular"
                    src="https://www.instagram.com/static/images/homepage/screenshots/screenshot1.png/fdfe239b7c9f.png"
                    alt="fondo_imagen">
            </div>
        </div>
        <div class="contenedor-login columna">
            <div class="tarjeta">
                <img class="user-logo" src="https://cdn.pixabay.com/photo/2016/04/15/18/05/computer-1331579__340.png"
                    alt="user">
                <div class="botones">
                    @if (Route::has('login'))
                        <div class="m-auto">
                            @auth
                                <a href="{{ route('home.dash.index') }}" class="btn btn-info text-white">Inicio</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary text-white">Ingresar</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ms-4 btn btn-primary text-white">Registrarse</a>
                                @endif
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        </div>




        {{-- <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 col-sm-12 text-center">
                    <div class="row ">
                        <div class="col-md-6 col-sm-12 text-right">
                            <img class="border-imagen"
                                src="https://www.instagram.com/static/images/homepage/screenshots/screenshot2.png/4d62acb667fb.png"
                                alt="fondo_imagen">
                        </div>
                        <div class="col-md-6 col-sm-12 text-left">
                            <img class="border-imagen"
                                src="https://www.instagram.com/static/images/homepage/screenshots/screenshot1.png/fdfe239b7c9f.png"
                                alt="fondo_imagen">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 m-auto">
                    <div class="tarjeta">
                        <img class="user-logo"
                            src="https://cdn.pixabay.com/photo/2016/04/15/18/05/computer-1331579__340.png" alt="user">
                        <div class="d-flex ">
                            @if (Route::has('login'))
                                <div class="m-auto">
                                    @auth
                                        <a href="{{ route('home.dash.index') }}" class="text-muted">Inicio</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary">Ingresar</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ms-4 btn btn-primary">Registrarse</a>
                                        @endif
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}
    </body>

    </html>
