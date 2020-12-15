<!--  -->

@extends('layouts.app3')

@section('title', 'App Dashboard - Post Control (ADMIN) ')


@section('content2')


<div class="">
    @if(\Session::has('job'))
      <div class="alert alert-primary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{ session('job') }}.
      </div>
    @endif
    <h3>Post Control </h3>
    <br>

  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>(ID#) Post</th>
        <th>Updated</th>
        <th>Comments (P-O)</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $post)
      <tr>
        <td>({{ $post->id }}#) {{ \Illuminate\Support\Str::words($post->message, 4,'...') }}</td>
        <td>{{ $post->updated_at }}</td>
        <td>{{ $post->comments->count() }} [{{ $post->user->name }}]</td>
        <td>
          @if($post->deleted_at === NULL)
            <button onclick="$(this).parent().find('#reply').submit()" class="sazal btn btn-primary btn-sm">Raply</button>
            <form id="reply" method="POST" action="{{ route('post.show', $post->id) }}">
                @method('GET')
                @csrf
            </form>

            @if($post->active === 0)
              <button onclick="$(this).parent().find('#publish').submit()" class="sazal btn btn-warning btn-sm">Publish Post</button>
              <form id="publish" method="POST" action="{{ route('post.publish.admin', $post->id) }}">
                  @method('PUT')
                  @csrf
              </form>
            @else
              <button class="sazal btn btn-dark btn-sm" disabled>Published</button>
              <br>
            @endif


            <button onclick="$(this).parent().find('#delete').submit()" class="sazal btn btn-danger btn-sm">Delete</button>
            <form id="delete" method="POST" action="{{ route('post.delete.admin', $post->id) }}">
                @method('DELETE')
                @csrf
            </form>
          @else
            <strong>DELETED POST</strong>
          @endif
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>

  {{ $posts->links() }}

<br>
<br>

</div>



@endsection
