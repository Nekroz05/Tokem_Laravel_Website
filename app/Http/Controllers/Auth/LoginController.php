<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        // DD();
        return view('auth.login');
    }

    public function signIn(Request $request){
        // DD($request->remember);
        $userInfo = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $userInfo = $request->only('email','password');
        // DD($userInfo);
        if(Auth::attempt($userInfo)){

            if($request->remember == 'on' ){
                Cookie::queue(Cookie::make('remember_email',$request->email,2628000));
            }
            return view('General.home');
        }
        return redirect() -> route('login')->withInput()->withErrors(['wrong'=>'Wrong Credentials']);

    }
}
