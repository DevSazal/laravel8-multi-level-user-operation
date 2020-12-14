<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>@yield('title') - Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) </title>

        <link rel="shortcut icon" type="image/png" href="{{ asset('images/react.png') }}" sizes="16x16"/>
        <!-- Bootstrap CSS From Laravel Default -->
        <!-- Styles  File-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito';
            }
            .w-5{
              display: none!important;
            }
            p.text-sm.text-gray-700.leading-5 {
                margin-top: 1rem;
            }
        </style>
    </head>
    <body>
      <!-- A grey horizontal navbar that becomes vertical on small screens -->
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ url('/') }}"><b>Logo</b></a>

        <!-- Links -->
        @if (Route::has('login'))
            <ul class="navbar-nav">
              @auth
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                  </li>
              @else
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                      </li>
                  @endif
              @endauth
            </ul>
        @endif
      </nav>



      <div class="container">
            @yield('content')
      </div>



      <!-- jQuery and Bootstrap Bundle (includes Popper) -->
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>

    </body>
</html>
