<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function updateName(Request $request)
    {
        $request->validate([
            "name" => ["required", "min:2", "max:30"]
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('user.index')->with([
            "success" => "Le nom d'utilisateur a été modifié"
        ]);
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            "email" => "required|email:rfc,dns|unique:users,email",
        ]);

        $user->email = $request->email;
        $user->is_activated = false;
        $user->save();

        return redirect()->route('user.index')->with([
            "success" => "L'adresse e-mail a été changée. Veuillez valider la modification en utilisant le lien"
            ." qui vous a été envoyé par e-mail"
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            "current_password" => "required|current_password",
            "new_password" => "required|same:repeat_password|ascii|min:8|max:32|different:current_password",
            "repeat_password" => "required"
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.index')->with([
            "success" => "Le mot de passe a été changé"
        ]);
    }

    public function destroy(Request $request){
        $user = Auth::user();
        $request->validate([
            "current_password" => "required|current_password"
        ]);

        $user->delete();

        return redirect()->route('home')->with([
            "success" => "Votre compte a bien été supprimé"
        ]);
    }
}
