<?php

namespace App\Http\Controllers\Staff;

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
    return view('staff.login');
  }

  public function loginUser(Request $request){

    $request->validate([
                    'email' => 'required|string',
                    'password' => 'required|string',
                ]);
    $staff = User::withTrashed()->where('email', $request->email)
                  ->where('role_type', 'staff')
                  ->value('email');
    if($staff === NULL){
      // Role Gate
      return redirect('/staff/login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    $credentials = $request->only('email', 'password');

                if (Auth::attempt($credentials)) {
                    return redirect()->intended('/staff');
                }

                // code... disabled id check
                $onlyTrashed = \App\Models\User::onlyTrashed()->where('email', $request->email)->first();
                if($onlyTrashed){
                  return redirect('/staff/login')->with('error', 'Sorry! Your account is currently disabled.');
                }

    return redirect('/staff/login')->with('error', 'Oppes! You have entered invalid credentials');

  }

  public function logout() {
    Auth::logout();

    return redirect('/staff/login');
  }

  public function disable() {
    $user = User::find(Auth::user()->id);
    $result = $user->delete();
    Auth::logout();

    return redirect('/staff/login')->with('error', 'Okey! Your account disable process is completed, Thank You');
  }

}
