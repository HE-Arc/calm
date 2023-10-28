<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view("login", ["page" => "login", "pageTitle" => "Connexion",
            "pageDescription" => "Formulaire de connexion à CALM"]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
            ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'Invalid e-mail and/or password'
        ])->onlyInput('email');
    }

    public function registerForm()
    {
        return view("register", ["page" => "register", "pageTitle" => "Inscription",
            "pageDescription" => "Formulaire d'inscription à CALM"]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'));
    }
}
