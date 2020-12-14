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
        </style>
    </head>
    <body>


      <div class="container">
            @yield('content')
      </div>



    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    </body>
</html>
