<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <style>
        body {
          min-height: 100vh;
          margin: 0;
          font-family: Arial, Helvetica, sans-serif;
          background-image: url('{{ asset('images/background70.jpg') }}');
        background-size: cover;
        background-position: center;
        
        
        }
        
        .topnav {
          overflow: hidden;
          background-color: #333;
          margin-bottom: 15px;
        }
        
        .topnav a {
          float: left;
          color: #f2f2f2;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
          font-size: 17px;
        }
        
        .topnav a:hover {
          background-color: rgba(255, 214, 51);
          color: black;
        }
        
        .topnav a.active {
          
          color: white;
          text-transform: uppercase;
        }
        </style>
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <!-- Scripts -->
  {{--  <script src="{{ asset('js/app.js') }}" defer></script>--}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
               {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}--}}
                </a>
                <!-- Add your navigation links or menus here -->
                <div class="topnav">
                    <a class="active" href="{{ route('home') }}">{{ __('messages.My home') }}</a>
                    <a href="{{ route('vote') }}">@lang('messages.Vote')</a>
                    <a href="{{ route('wall') }}">@lang('messages.Wall')</a>
                    <a href="{{ route('about') }}">@lang('messages.About Us')</a>
                    <div class="logout">
                       <a> <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">@lang('messages.Logout')</button>
                        </form></a>
                        <a href="{{ route('switch-language', ['locale' => 'lv']) }}">LV</a>
                        <a href="{{ route('switch-language', ['locale' => 'en']) }}">EN</a>

                  </div>



            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
