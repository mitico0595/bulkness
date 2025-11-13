<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@include ('title')</title>
    @include ('logo')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/register-version.css') }}" rel="stylesheet">
    <style type="text/css">
    .bottom{
        display: none;
    }
    .top{
        display: none;
    }
     @media (max-width: 749px){
            .top{
                display: block;
            }
        }
        @media (min-width: 750px){
            .bottom{
                display: block;
            }
        }

    </style>
</head>

<body style="background:#1f1f1f">
    <div class="contenido">
        <div class="content">
            <a href="{{url('/')}} "><img src="{{asset('image/oberlu_intro.png')}} " alt="" style="width: 100%;"></a>
            <div class="top" style="margin-top: 50px;">
                <a href="
                @if (Auth::user()->type == 0)
                	{{url('index-profile')}}
                @endif
                @if (Auth::user()->type == 1)
                	{{url('admin-mobile')}}
                @endif
                @if (Auth::user()->type == 2)
                	{{url('prov-mobile')}}
                @endif
                " class="border" style="border: 2px solid #b10000;border-radius:5px;">
                    <img src="{{asset('image/svg/mobile-phone.svg')}}" class="imagen">
                    <span class="letter" style="color:#b40000;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;">Mobile Version</span>
                </a>
            </div>
            <div class="bottom" style="margin-top: 50px;">
                <a href="
                @if (Auth::user()->type == 0)
                	{{url('usuario')}}
                @endif
                @if (Auth::user()->type == 1)
                	{{url('app')}}
                @endif
                @if (Auth::user()->type == 2)
                	{{url('supplier')}}
                @endif

                " class="border" style="border: 2px solid #b10000;border-radius:5px;">
                    <img src="{{asset('image/svg/desktop.svg')}}" class="imagen">
                    <span class="letter" style="color:#b40000;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;right:80px">Desktop Version</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
