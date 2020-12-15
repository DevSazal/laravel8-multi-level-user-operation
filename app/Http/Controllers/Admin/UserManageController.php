<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserManageController extends Controller
{
  public function __construct(){
    $this->middleware('admin');
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
    }elseif ($request->super) {
      // code...
      $array['users'] = User::withTrashed()
                        ->where('role_type', 'admin')
                        ->orWhere('role_type', 'staff')
                        ->orderBy('role', 'desc')->paginate(10);
    }else {
      // code... display all users
      $array['users'] = User::withTrashed()->orderBy('id', 'desc')->paginate(10);
    }
    return view('admin.users')->with($array);
  }

  public function createStaff(Request $request){

    // code...  User Data Validation
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|min:3|max:50',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|max:80|required_with:password_confirmation|confirmed'
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)
                      ->withInput();
        // return dd($validator->errors());
    }else {

      // ... save staff
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->role = 1;
      $user->role_type = 'staff';
      $result = $user->save();

        if($result){
          $request->session()->flash('job', 'A Staff has been created successfully for '.$request->email);
          // return ["result" => "Data has been saved."];
          return redirect('/admin/users');
        }else{
          return ["result" => "Operation Failed!"];
        }
    }
  }


}
