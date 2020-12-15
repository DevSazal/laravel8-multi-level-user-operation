<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use Auth;
use Validator;

class PostController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  // control login Post Logout
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



}
