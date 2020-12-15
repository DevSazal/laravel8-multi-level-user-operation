<!--  -->

@extends('layouts.app-auth')

@section('title', 'Login (Staff) ')


@section('content')

<div class="jumbotron text-center">
  <h1>Login (Staff)</h1>
  <p></p>
</div>

@if(\Session::has('register'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> You have been successfully registered as <b>{{ session('register') }}</b>.
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible" style="">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>{{ session('error') }}</strong>.
  </div>
@endif

<form action="{{ route('login.staff') }}" method="POST">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputUserName">Email</label>
      <input type="text" name="email" class="form-control" id="inputUserName">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword">
    </div>
  </div>


  <div class="form-group">
    <div class="form-check">

    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign In</button>
  <!-- <a href="{{ url('/register') }}"> Go to Register page ...</a> -->
</form>
@endsection
