<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use Auth;
use Validator;


class PostManageController extends Controller
{
  public function __construct(){
    $this->middleware('staff');
  }
  // Listed Post Logout
  public function index(){
    $array['posts'] = Post::withTrashed()->orderBy('id', 'desc')->paginate(10);
    return view('staff.index')->with($array);
  }


  public function delete($id, Request $request){

        $post = Post::find($id);
        $result = $post->delete();

        if($result){
          $request->session()->flash('job', 'Post has been deleted');
          return redirect('/staff');
        }else{
          $request->session()->flash('job', 'Post Delete Operation Failed');
          return redirect('/staff');
        }

  }

  public function publish($id, Request $request){

        $post = Post::find($id);
        $post->active = 1;
        $result = $post->save();

        if($result){
          $request->session()->flash('job', 'The Post Has Been Published');
          return redirect('/staff');
        }else{
          $request->session()->flash('job', 'Post Publish Operation Failed');
          return redirect('/staff');
        }


  }



}
