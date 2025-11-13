<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@include ('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <!-- Styles -->
    <link href="{{ asset('css/register-version.css') }}" rel="stylesheet">
</head>
<body>
    <div class="contenido">
        <div class="content">
            <div class="top">
                <a href="{{url('index-profile')}} " class="border">
                    <img src="{{asset('image/svg/mobile-phone.svg')}}" class="imagen">
                    <span class="letter">Mobile Version</span>
                </a>
            </div>
            <div class="bottom">
                <a href="" class="border">
                    <img src="{{asset('image/svg/desktop.svg')}}" class="imagen">
                    <span class="letter">Desktop Version</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>