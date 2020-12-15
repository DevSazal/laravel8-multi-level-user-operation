<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator; // validator class for rules
// add model
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
  // control login Register Logout
  public function registerPage(){
    return view('register');
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
          return redirect('/login');
        }else{
          return ["result" => "Operation Failed!"];
        }
    }
  }

  // login function
  public function loginPage(){
    return view('login');
  }

  public function loginUser(Request $request){

    $request->validate([
                    'email' => 'required|string',
                    'password' => 'required|string',
                ]);

    $credentials = $request->only('email', 'password');

                if (Auth::attempt($credentials)) {
                    return redirect()->intended('/');
                }

                // code... disabled id check
                $onlyTrashed = \App\Models\User::onlyTrashed()->where('email', $request->email)->first();
                if($onlyTrashed){
                  return redirect('login')->with('error', 'Sorry! Your account is currently disabled.');
                }

    return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');

  }

  public function logout() {
    Auth::logout();

    return redirect('login');
  }

  public function disable() {
    $user = User::find(Auth::user()->id);
    $result = $user->delete();
    Auth::logout();

    return redirect('login');
  }

}
