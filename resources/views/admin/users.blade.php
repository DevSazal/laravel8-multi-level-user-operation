<!--  -->

@extends('layouts.app3')

@section('title', 'App Dashboard - Users ')


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
        <form action="{{ route('users') }}" style="">
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
        <a href="{{ url('/staff/users?active=false') }}" class="btn btn-danger sazal"><i class="fas fa-plus-circle"></i> Filter inActive </a>
        <a href="{{ url('/staff/users') }}" class="btn btn-dark sazal"><i class="fas fa-plus-circle"></i> Reset </a>
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
          <td>{{ $user->email }}</td>
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



</div>



@endsection
