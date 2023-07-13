<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index(){
        // DD();
        return view('login');
    }

    public function home()
    {
        return view('General.home');
    }

    public function logout(){
        // DD();
        Auth::logout();

        return view('General.home');
    }

    public function profile(){
        // DD();

        return view('Authorized.profile');
    }

    public function update_page(){
        return view('Authorized.update_profile');
    }

    protected function validator(Array $data)
    {
        // dd("here");
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'min:11'],
            'address' => ['required', 'min:15'],
        ],$messages = [
            'password.same' => 'Password and confirmation must be the same'
        ]);
    }

    public function edit(Request $req){
        // dd($req->all());
        $user = Auth::user();
        // dd(strcmp($req['password'], $req['confirm']) !== 0);
        // if(strcmp($req['password'], $req['confirm']) !== 0 ){
        //     return redirect()->route('profile')->withErrors(["Password and confirm password is not matching"]);
        // }
        // dd("here");

        $validator = $this->validator($req->all());
        if($validator->errors()->any()){
            return redirect()->back()->withErrors($validator->errors()->all());
        }
        // $req->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed', 'same:'.$req['confirm']],
        //     'phone' => ['required', 'numeric', 'min:11'],
        //     'address' => ['required', 'min:15'],

        // ]);

        $user->update([
            'name' => $req['name'],
            'password' => Hash::make($req['password']),
            'phone' => $req['phone'],
            'address' => $req['address'],
            'role' => $user->role,
        ]);

        return redirect()->route('profile')->withSuccess(["Profile updated"]);

    }

}
