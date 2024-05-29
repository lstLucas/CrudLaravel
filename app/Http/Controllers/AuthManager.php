<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    
    public function auth(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);

        $user = User::where('email', $credentials['email'])->first();


        if ($user && $user->isActive && Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('user/list');
        } else if ($user && !$user->isActive) {
            return redirect(route('login'))->with('error', 'Your account is inactive. Please contact support.');
        }

        return redirect(route('login'))->with('error', 'Email or Password Incorrect');
    }

    public function login(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('login');
    }

    public function register(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('register');
    }
    
    public function create(Request $request){

        try {
            $credentials = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required'],
            ]);
            $data['name'] = $credentials['name'];
            $data['email'] = $credentials['email'];
            $data['password'] = Hash::make($credentials['password']);
            User::create($data);

        } catch (\Exception $e) {
            return redirect(route('register.form'))->with('error', 'Error creating your account, try again!');
        }

        if(Auth::check()){
            return redirect('/')->with('success', 'Account created!');
        }

        return redirect(route('login'))->with('success', 'Account created!');

    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
