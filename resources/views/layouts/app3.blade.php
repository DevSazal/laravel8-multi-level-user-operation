<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>@yield('title') - (Private) Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) </title>

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
                background-color: #48d8a9;
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


      <div class="container-fluid">


        <div class="jumbotron text-center">
          <h1>Welcome</h1>
          <p>{{ Auth::user()->name }} <span style="color: red">({{ Auth::user()->role_type }})</span> </p>
        </div>


        <?php $segment = Request::segment(1) ?>
        <div class="row">
          @if(Auth::user()->role_type === 'staff')
          <div class="col-md-3">
              <div class="list-group">
                  <a href="{{ url('/staff') }}" class="list-group-item list-group-item-action
                        @if($segment=='staff' && Request::segment(2)=='')
                          active
                        @endif"><i class="fas fa-arrow-alt-circle-right"></i>
                    Posts (Control)
                  </a>
                  <a href="{{ url('/staff/users') }}" class="list-group-item list-group-item-action
                      @if($segment=='staff' && Request::segment(2)=='users')
                        active
                      @endif"><i class="fas fa-arrow-alt-circle-right"></i>
                    Users
                  </a>
              </div>
              <br>
              <br>
              <div class="">
                <a href="{{ url('/staff/logout') }}"> @STAFF Logout</a>
              </div>
              <div class="">
                <a href="{{ url('/') }}"> ~ Go to User Home Page</a>
              </div>
          </div>
          @endif
          @if(Auth::user()->role_type === 'admin')
          <div class="col-md-3">
              <div class="list-group">
                  <a href="{{ url('/admin') }}" class="list-group-item list-group-item-action
                        @if($segment=='admin' && Request::segment(2)=='')
                          active
                        @endif"><i class="fas fa-arrow-alt-circle-right"></i>
                    Posts (Control)
                  </a>
                  <a href="{{ url('/admin/users') }}" class="list-group-item list-group-item-action
                      @if($segment=='admin' && Request::segment(2)=='users')
                        active
                      @endif"><i class="fas fa-arrow-alt-circle-right"></i>
                    Users
                  </a>
              </div>
              <br>
              <br>
              <div class="">
                <a href="{{ url('/admin/logout') }}"> @Admin Logout</a>
              </div>
              <div class="">
                <a href="{{ url('/') }}"> ~ Go to User Home Page</a>
              </div>
          </div>
          @endif
          <div class="col-sm-9">
            @yield('content2')
          </div>

        </div>


      </div>



    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    </body>
</html>
