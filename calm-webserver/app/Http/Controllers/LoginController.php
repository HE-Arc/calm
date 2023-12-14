<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        // Check if Remember me is check
        $remember = $request->has('remember');

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'E-mail ou mot de passe incorrect'
        ])->onlyInput('email');
    }

    public function registerForm()
    {
        return view("register", ["page" => "register", "pageTitle" => "Inscription",
            "pageDescription" => "Formulaire d'inscription à CALM"]);
    }

    public function register(Request $request){
        $request->validate([
            "name" => "required|ascii|min:2|max:32",
            "email" => "required|email:rfc,dns|unique:users,email",
            "password" => "required|ascii|min:8|max:32|same:passwordConfirmation",
            "passwordConfirmation" => "required"
        ]);

        $userData = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "is_activated" => false,
            "is_admin" => false,
        ];

        // Check if admin field is check
        if ($request->has('isAdmin')) {
            $userData['is_admin'] = true;
        }

        User::create($userData);

        $id = User::where('email', $request->email)->first()->id;
        Auth::loginUsingId($id);

        return redirect()->route('home')->with([
            "success" => "Votre compte a été créé"
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'));
    }
}
