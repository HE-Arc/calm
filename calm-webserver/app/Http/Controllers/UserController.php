<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view(
            "user.index",
            [
                "page" => "account",
                "pageTitle" => "Compte",
                "pageDescription" => "Accéder à toutes vos informations de compte. Vous pouvez les consulter et les modifier.
                Vous pouvez également supprimer votre compte.",
            ],
        );

    }
}
