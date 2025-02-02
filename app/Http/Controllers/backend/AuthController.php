<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    public function login(){
        return view('backend.auth.login');
    }
    public function register(){
        return view('backend.auth.register');
    }
    public function submitRegister(Request $request){
        $username = $request -> input('name');
        $email    = $request -> input('email');
        $password = $request -> input('password');
        $profile  = $request -> file('profile');

        $path     = './assets/image';
        $image    = time().'-'.$profile->getClientOriginalName();
        $profile  -> move($path, $image);
        
        $result   = DB::table('users')->insert([
            'name'    =>$username,
            'email'   =>$email,
            'password'=> Hash::make($password),
            'profile' =>$image
        ]);
        if($result){
            return redirect()->route('login');
        }
    }
    public function submitLogin(Request $request){
        $username_email = $request -> input('name_email');
        $password       = $request -> input('password');

        if(Auth::attempt(['name'=>$username_email,'password'=>$password])){
            return redirect()->route('deshboard');
        }elseif(Auth::attempt(['email'=>$username_email,'password'=>$password])){
            return redirect()->route('deshboard');
        }else{
            return redirect()->back()->with('message', 'field to login');
        }
    }
    // Logout
    public function logout(){
        return view('backend.auth.logout');
    }
    public function submitLogout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
