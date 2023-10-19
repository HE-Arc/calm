<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('login', ['page' => 'login', 'pageTitle' => "Connexion",
            'pageDescription' => "Formulaire de connexion à CALM"]);
    }
}
