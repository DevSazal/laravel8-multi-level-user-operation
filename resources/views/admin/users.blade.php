<!--  -->

@extends('layouts.app3')

@section('title', 'Users & Assign New Staff (ADMIN) ')


@section('content2')


<div class="">
    @if(\Session::has('job'))
      <div class="alert alert-primary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{ session('job') }}.
      </div>
    @endif
    <div class="row">
      <div class="col-md-2">
        <h3>Users</h3>
      </div>
      <div class="col-md-6">
        <form action="{{ route('users.admin') }}" style="">
          <div class="form-row">

            <div class="form-group col-md-8">
              <input type="text" name="key" class="sazal form-control" id="" placeholder="type as name or email ..." value="{{ old('key') }}" required>

              @error('key')
                  <div class="mt-2" style="color: #dc3545;">
                      {{ $message }}
                  </div>
              @enderror

            </div>

            <div class="form-group col-md-4">
              <button type="submit" style="float: right; border-radius: 0rem" class="btn btn-primary btn-block">Search User</button>
            </div>

          </div>
        </form>
      </div>
      <div class="col-md-4">
        <a href="{{ url('/admin/users?active=false') }}" class="btn btn-danger sazal"><i class="fas fa-plus-circle"></i> Filter inActive </a>
        <a href="{{ url('/admin/users') }}" class="btn btn-dark sazal"><i class="fas fa-plus-circle"></i> Reset </a>
        <br>
        <a href="{{ url('/admin/users?super=true') }}" class="btn btn-info sazal" style="margin-top:15px;margin-bottom:15px;"><i class="fas fa-plus-circle"></i> Only Admin & Staff </a>
      </div>
    </div>


    <table class="table table-dark table-hover">
      <thead>
        <tr>
          <th>(ID#) Name</th>
          <th>Email</th>

          <th>Post</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>({{ $user->id }}#) {{ $user->name }}</td>
          <td>
            {{ $user->email }}
            @if($user->role >= 1)
             <span style="color: #3baf79;font-weight: 800;text-transform: capitalize;"> ({{ $user->role_type }})</span>
            @endif
          </td>
          <td>({{ $user->posts->count() }})</td>
          <td>
            @if($user->deleted_at === NULL)
              <strong>Active User</strong>
            @else
              <strong style="color: #ff9595"> DISABLED ACCOUNT! </strong>
            @endif
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>

  {{ $users->links() }}


<div class="row">
  <div class="col-md-12" id="#add">
    <br>
    <br>
    <div class="card">
      <div class="card-body">
        <form action="{{ route('assign.staff.admin') }}" method="POST">
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
              <label for="inputPassword">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" id="inputPassword2">

            </div>
          </div>

          <button type="submit" class="btn btn-primary sazal">Add New Staff</button>
        </form>
      </div>
    </div>
    <br>

    <br>

  </div>
</div>

</div>



@endsection
