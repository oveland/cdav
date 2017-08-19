<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CDAV Gestión de Patios</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <!-- Styles -->
        <style>
            .hide{
                display: none;
            }
            .btn-danger{
                background: darkred;
                padding: 15px !important;
                color: #bdbdbd !important;
                -webkit-transition: all 0.3s !important; /* Safari */
                transition:  all 0.3s !important; /* Safari */
            }

            .btn-danger:hover{
                background: #400000;
                padding: 15px;
                color: white !important;
                -webkit-box-shadow: 0px -1px 8px 2px rgba(0,0,0,1);
                -moz-box-shadow: 0px -1px 8px 2px rgba(0,0,0,1);
                box-shadow: 0px -1px 8px 2px rgba(0,0,0,1);
            }

            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .white{
                color: white !important;
            }
            .red{
                color: #f30327 !important;
                text-shadow: 1px 1px 8px rgba(255, 78, 0, 1);
            }

            body{
                overflow-x: hidden!important;
                min-height: 100%;
                z-index: -2;
                background: url(/img/banner.jpg) no-repeat top center fixed;
                -moz-background-size: cover;
                -webkit-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        </style>
        <script>
            $(document).ready(function () {
                $('body').fadeIn(2000);
                $('.content').hide().removeClass('hide').slideDown(2000);
            })
        </script>
    </head>
    <body class="hide">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links hide">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content hide" style="height: 300px">
                <div class="title m-b-md">
                    <span class="white">CDAV</span> <span class="red">Gestión de Patios</span>
                </div>

                <div class="links" style="margin-top:100px; ">
                    <a href="{{ url('/beta/inventories') }}" class="btn btn-lg btn-danger">Versión inicial BETA*</a>
                </div>
            </div>
        </div>
    </body>
</html>
