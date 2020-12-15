<!--  -->

@extends('layouts.app')

@section('title', 'Timeline')


@section('content')
<br/>
<div class="row justify-content-center">
    <div class="col-md-8">
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

        <form action="{{ route('storePost') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label><b>What is in your mind?</b></label>
            <textarea class="sazal form-control " id="exampleFormControlTextarea1"
              rows="4" name="message" placeholder="write something...">{{ old('message') }}</textarea>
              @error('message')
                  <div class="mt-2" style="color: #dc3545;">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          <div class="form-row">

            <div class="form-group col-md-8">
              <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="customFile" accept="image/*">
                <label class="custom-file-label sazal" for="customFile">You can choose image (optional)</label>
              </div>
              @error('image')
                  <div class="mt-2" style="color: #dc3545;">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group col-md-4">
              <button type="submit" style="float: right; border-radius: 0rem" class="btn btn-primary btn-block">Post Now</button>
            </div>

          </div>
        </form>

    </div>

</div>
<br/>

<br/>
<div class="row justify-content-center">
    <div class="col-md-12">
      @forelse($posts as $post)
        @if($post->user)
          <div>
            <div class="card" >
                <div class="card-body">
                  <h4>
                    <a href="{{ url('/post/'.$post->id) }}">{{ \Illuminate\Support\Str::words($post->message, 32,'...') }}</a>
                  </h4>
                  <br/>

                </div>
                <div class="card-header" style="color:#fff">@<b>{{ $post->user->name }}</b> | <span class="sp-color">{{ $post->updated_at }}</span>
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
        @endif
      @empty
        <div class="col-md-12">
            <div class="alert" role="alert" style="color: white;font-size: 17px;font-weight: 900;background: #39c395;border-color: #d6e9c6;">
                  No Post Found!
            </div>
        </div>
      @endforelse
    </div>
</div>



{{ $posts->links() }}


@endsection
