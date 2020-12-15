<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use Validator;

class UserManageController extends Controller
{
  public function __construct(){
    $this->middleware('staff');
  }
  // Listed Post Logout
  public function index(Request $request){
    // code... user listed by key like as search
    if($request->key){
      $array['users'] = User::withTrashed()
                        ->where('name', 'LIKE', "%{$request->key}%")
                        ->orWhere('email', 'LIKE', "%{$request->key}%")
                        ->orderBy('id', 'desc')->paginate(10);
    }elseif ($request->active) {
      // code...
      $array['users'] = User::onlyTrashed()
                        ->orderBy('id', 'desc')->paginate(10);
    }else {
      // code... display all users
      $array['users'] = User::withTrashed()->orderBy('id', 'desc')->paginate(10);
    }
    return view('staff.users')->with($array);
  }
}
