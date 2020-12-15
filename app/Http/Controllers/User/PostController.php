<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use Auth;
use Validator;
use App\Models\Comment;

class PostController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  // control Post Logout
  public function index(){
    $array['posts'] = Post::where('active', 1)->orderBy('id', 'desc')->paginate(6);
    return view('user.index')->with($array);
  }

  public function storePost(Request $request){

    // code...  Data Validation
    $validator = Validator::make($request->all(), [
        'message' => 'required|string|min:2',
        'image' => 'nullable|mimes:jpg,jpeg,gif,png'
    ]);

    //

    if ($validator->fails()) {
        return back()->withErrors($validator)
                      ->withInput();
        // return dd($validator->errors());
    }else {

      if(isset($request->image)){
          if($request->image->getClientOriginalName()){
                  $ext = $request->image->getClientOriginalExtension();
                  $file = date('YmdHis').'_'.rand(1,999).'.'.$ext;
                  $file_path = $request->image->storeAs('post-image', $file, 'public');


              }else{
                  $file_path = NULL;
              }
      }else{
          $file_path = NULL;
      }

      // ... save post data
      $post = new Post;
      $post->message = $request->message;
      $post->user_id = Auth::user()->id;
      $post->image = $file_path;
      $result = $post->save();

        if($result){
          $request->session()->flash('added_post', $post->id);
          // return ["result" => "Data has been saved."];
          return redirect('/');
        }else{
          return ["result" => "Operation Failed!"];
        }
    }
  }

  public function delete($id, Request $request){

    if(Auth::user()->role >= 1){
        $post = Post::find($id);
        $result = $post->delete();

        if($result){
          $request->session()->flash('job', 'Post has been deleted');
          return redirect('/');
        }else{
          $request->session()->flash('job', 'Post Delete Operation Failed');
          return redirect('/');
        }

      }
    return abort(403, 'Unauthorized action');
  }

  // Post Show + Comment Logout
  public function show($id){
    $array['post'] = Post::find($id);
    //$array['comments'] = Comment::find($id);
    return view('user.post')->with($array);
  }

  public function makeComment($id, Request $request){

    // code...  Data Validation
    $validator = Validator::make($request->all(), [
        'comment' => 'required|string|min:2',
        '_type' => 'required|string|min:2',
        '_id' => 'required|integer|max:20'
    ]);

    //

    if ($validator->fails()) {
        return back()->withErrors($validator)
                      ->withInput();
        // return dd($validator->errors());
    }else {

      $com = new Comment;
      $com->comment = $request->comment;
      $com->user_id = Auth::user()->id;
      $com->commentable_type = $request->_type;
      $com->commentable_id = $request->_id;
      $result = $com->save();

        if($result){
          $request->session()->flash('job', 'Your comment has been published regarding this post');
          return back();
        }else{
          $request->session()->flash('job', 'Comment Operation Failed');
          return back();
        }
    }
  }



}
