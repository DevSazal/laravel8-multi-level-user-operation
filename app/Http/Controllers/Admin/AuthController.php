<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator; // validator class for rules
// add model
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
  // login function
  public function loginPage(){
    return view('admin.login');
  }

  public function loginUser(Request $request){

    $request->validate([
                    'email' => 'required|string',
                    'password' => 'required|string',
                ]);
    $staff = User::withTrashed()->where('email', $request->email)
                  ->where('role_type', 'admin')
                  ->value('email');
    if($staff === NULL){
      // Role Gate
      return redirect('/admin/login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    $credentials = $request->only('email', 'password');

                if (Auth::attempt($credentials)) {
                    return redirect()->intended('/admin');
                }

                // code... disabled id check
                $onlyTrashed = \App\Models\User::onlyTrashed()->where('email', $request->email)->first();
                if($onlyTrashed){
                  return redirect('/admin/login')->with('error', 'Sorry! Your account is currently disabled.');
                }

    return redirect('/admin/login')->with('error', 'Oppes! You have entered invalid credentials');

  }

  // Register Logout
  public function registerPage(){
    return view('admin.register');
  }

  public function registerUser(Request $request){

    // code...  User Data Validation
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|min:3|max:50',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|max:80',
        'image' => 'required|mimes:jpg,jpeg,gif,png'
    ]);

    //

    if ($validator->fails()) {
        return back()->withErrors($validator)
                      ->withInput();
        // return dd($validator->errors());
    }else {
      // ... rename image
      $ext = $request->image->getClientOriginalExtension();
              $file = date('YmdHis').'_'.rand(1,999).'.'.$ext;
              $file_path = $request->image->storeAs('UserPhoto', $file, 'public');
      // ... save user data
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->profile_photo_path = $file_path;
      $result = $user->save();

        if($result){
          $request->session()->flash('register', $request->email);
          // return ["result" => "Data has been saved."];
          return redirect('/admin/login');
        }else{
          return ["result" => "Operation Failed!"];
        }
    }
  }

  public function logout() {
    Auth::logout();

    return redirect('/admin/login');
  }

  public function disable() {
    $user = User::find(Auth::user()->id);
    $result = $user->delete();
    Auth::logout();

    return redirect('/admin/login')->with('error', 'Okey! Your account disable process is completed, Thank You');
  }

}
