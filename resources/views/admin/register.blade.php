<!--  -->

@extends('layouts.app-auth')

@section('title', 'Register (admin)')


@section('content')

<div class="jumbotron text-center">
  <h1>Register (ADMIN)</h1>
  <p></p>
</div>

<form action="{{ route('register.admin') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName">Name</label>
      <input type="text" name="name" class="form-control" id="inputName" value="{{ old('name') }}">
      @error('name')
          <div class="mt-2" style="color: #dc3545;">
              {{ $message }}
          </div>
      @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail">Email</label>
      <input type="email" name="email" class="form-control" id="inputEmail" value="{{ old('email') }}">
      @error('email')
          <div class="mt-2" style="color: #dc3545;">
              {{ $message }}
          </div>
      @enderror
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword">
      @error('password')
          <div class="mt-2" style="color: #dc3545;">
              {{ $message }}
          </div>
      @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="inputPhoto">Upload Your Photo</label>
      <!-- <input type="file" class="form-control" id="inputEmail"> -->
      <div class="custom-file">
        <input type="file" name="image" class="custom-file-input" id="customFile" accept="image/*">
        <label class="custom-file-label" for="customFile">Choose file</label>
      </div>
      @error('image')
          <div class="mt-2" style="color: #dc3545;">
              {{ $message }}
          </div>
      @enderror
    </div>
  </div>


  <div class="form-group">
    <div class="form-check">

    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign Up</button>
  <a href="{{ url('/admin/login') }}"> Go to login page ...</a>
</form>
@endsection
