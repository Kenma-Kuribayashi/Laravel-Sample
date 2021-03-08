<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    // protected $redirectTo = '/articles';
    // protected function redirectTo () {
    // //   return route('dashboard');
    //   $this->middleware('auth');
    //   return redirect('/articles');
    // }
    
    public function login(Request $request)
    {
      $this->validate($request,[
      'email' => 'email|required',
      'password' => 'required|min:4'
      ]);
 
      if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

        return redirect('/');
      }
      return redirect()->back();
    }
    
    protected function loggedOut()
    {
      return redirect('/');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
      //logoutやshowLoginFormはトレイトのメソッド
      $this->middleware('guest')->except(['login','logout','showLoginForm']);
    }

    // protected function guard()
    // {
    //   return Auth::guard('web');
    // }
}
