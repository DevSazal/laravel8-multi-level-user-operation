<!--  -->

@extends('layouts.app')

@section('title', 'Post ('.$post->id.') ')


@section('content')
<br/>
<div class="row justify-content-center">
  @if(\Session::has('added_post'))
    <div class="alert alert-success alert-dismissible" style="margin-top: 0px; margin-bottom: 25px;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Success!</strong> Post has been submitted for approval <b>{{ session('added_post') }}</b>.
    </div>
  @endif
  @if(\Session::has('job'))
    <div class="alert alert-info alert-dismissible" style="margin-top: 0px; margin-bottom: 25px;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Okay!</strong> {{ session('job') }}.
    </div>
  @endif
    <div class="col-md-12">

      <div>
        <div class="card" >
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <p style="font-size: 1.0rem">
                    {{ $post->message }}
                  </p>
                </div>
                <div class="col-md-4">
                  @if($post->image)
                  <img src="{{ Storage::url($post->image) }}" class="mx-auto d-block rounded" style="max-height: 300px;max-width: 200px" alt="NULL">
                  @endif
                </div>
              </div>

              <br/>

            </div>
            <div class="card-header" style="color:#fff">@<b>{{ ($post->user)->name }}</b> | <span class="sp-color">{{ $post->updated_at }}</span>
              @if(Auth::user()->role >= 1)
                <button onclick="$(this).parent().find('#delete').submit()" class="sazal btn btn-danger btn-sm">Delete</button>


                <form id="delete" method="POST" action="{{ route('post.delete', $post->id) }}">
                    @method('DELETE')
                    @csrf
                </form>
              @endif
            </div>

        </div><br/>
      </div>

    </div>

</div>
<br/>

<br/>
<div class="row justify-content-center">
    <div class="col-md-12">
      <div class="" style="">
        <div class="row">
          <b style="padding-left: 20px;">All Comments:</b>
          @forelse($post->comments as $comment)
          <div class="col-md-12" style="background-color: #ffd3fa; padding: 15px; margin: 20px 10px;">
            <h6>@<b>{{ $comment->user->name }}</b> </h6>
            <p>{{ $comment->comment }}</p>
            <span>DATE: {{ $comment->created_at }}</span>
          </div>
            @foreach($comment->comments as $recursiveComment)
              <div class="col-md-12" style="    background-color: #c8d4f7; padding: 15px; margin: 10px 80px; margin-top: -10px;">
                <h6>@<b>{{ $recursiveComment->user->name }}</b> </h6>
                <p>{{ $recursiveComment->comment }}</p>
                <span>DATE: {{ $recursiveComment->created_at }}</span>
              </div>
            @endforeach
          <form action="{{ route('make.comment' , $post->id) }}" method="POST" style="margin: 0px 80px;">
          @csrf
            <div class="form-row">

              <div class="form-group col-md-8">

                <input type="text" name="comment" class="sazal form-control" id="" placeholder="What is your opinion?" value="{{ old('comment') }}" required>

                @error('comment')
                    <div class="mt-2" style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
                <input type="hidden" name="_type" value="Comment">
                <input type="hidden" name="_id" value="{{ $comment->id }}">
              </div>

              <div class="form-group col-md-4">
                <button type="submit" style="float: right; border-radius: 0rem" class="btn btn-primary btn-block">Reply</button>
              </div>

            </div>
          </form>
          @empty
            <div class="col-md-12">
                <div class="alert" role="alert" style="color: white;font-size: 17px;font-weight: 900;background: #39c395;border-color: #d6e9c6;">
                      No Comment Found!
                </div>
            </div>
          @endforelse

        </div>
      </div>

    </div>
</div>

<hr>

<form action="{{ route('make.comment', $post->id) }}" method="POST" >
@csrf
  <div class="form-row">

    <div class="form-group col-md-8">

      <input type="text" name="comment" class="sazal form-control" placeholder="What is your opinion?" id="" value="{{ old('comment') }}" required>

      @error('comment')
          <div class="mt-2" style="color: #dc3545;">
              {{ $message }}
          </div>
      @enderror
      <input type="hidden" name="_type" value="Post">
      <input type="hidden" name="_id" value="{{ $post->id }}">
    </div>

    <div class="form-group col-md-4">
      <button type="submit" style="float: right; border-radius: 0rem" class="btn btn-primary btn-block">Write A Comment</button>
    </div>

  </div>
</form>




@endsection
