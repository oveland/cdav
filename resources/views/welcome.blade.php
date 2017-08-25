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
                font-size: 70px;
            }

            .links > a, .links > button {
                color: #636b6f;
                padding: 0 10px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                border: 0;
                width: 250px;
            }
            button:focus{
                outline:0 !important;
                width: 300px;
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
                background: url(banner.jpg) no-repeat top center fixed;
                -moz-background-size: cover;
                -webkit-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            .form-control{
                background: transparent;
                border: 2px solid gray;
                border-radius: 10px;
                height: 20px;
                width: 300px;
                color: #d0d0d0;
                transition: all 1s !important;
                padding:8px;
            }
            .form-control:active{
                border: 2px solid #d6d6d6;
            }.form-control:focus{
                outline:0 !important;
                border: 2px solid #d6d6d6;
            }
            .form-group label{
                color: whitesmoke !important;
                margin-bottom: 20px !important;
            }
            .help-block{
                width: auto !important;
                display: block;
                margin-bottom: 20px;
            }
            .alert{
                color: #b7baa2;
                font-weight: bold;
                margin-bottom: 20px;
                text-transform: uppercase;
                background: rgba(182, 71, 71, 0.35);
                width: 350px;
                margin: auto;
                padding: 20px;
            }
            .form-horizontal{
                margin-top: 10px !important;
            }
        </style>
        <script>
            $(document).ready(function () {
                $('body').fadeIn(2000);
                $('.content').hide().removeClass('hide').fadeIn(3000);
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

            <div class="content hide" style="height: auto">
                <div class="title m-b-md">
                    <span class="white">CDAV</span> <span class="red">Gestión de Patios</span>
                </div>

                @include('flash::message')

                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    @if ($errors->has('username'))
                        <span class="help-block" style="width: 100%">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-md-4 control-label">@lang('Username')</label>
                        <div class="col-md-6">
                            <input id="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                        </div>
                    </div>
                    <hr style="border-color: transparent">
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">@lang('Password')</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="links" style="margin-top:20px;margin-bottom: 100px">
                        <button class="btn btn-lg btn-danger" onclick="document.form.submit">
                            @lang('Login') <span style="font-size: 60%">Versión inicial BETA</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
