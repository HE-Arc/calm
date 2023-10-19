<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view("login", ["page" => "login", "pageTitle" => "Connexion",
            "pageDescription" => "Formulaire de connexion à CALM"]);
    }

    public function registerForm()
    {
        return view("register", ["page" => "register", "pageTitle" => "Inscription",
            "pageDescription" => "Formulaire d'inscription à CALM"]);
    }
}
