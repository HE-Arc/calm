<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Management\InvitationController;
use App\Models\Invitation;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            "passwordConfirmation" => "required",
        ]);

        $userData = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "is_activated" => false,
            "is_admin" => $request->has("isAdmin"),
        ];


        // Check if join code exists
        if ($request->has("code") && !empty($request["code"])) {
            if($userData["is_admin"]){
                return back()
                    ->withErrors([
                        "Les administrateurs ne sont pas autorisé à rejoindre une organisation avec un code d'invitation"
                    ])->withInput();
            }

            $invitation = Invitation::get_from_code($request["code"]);

            if(is_null($invitation))
            {
                return back()->withErrors([
                    "Le code n'existe pas ou n'est plus valide !"
                ])->withInput();
            }

            User::create($userData);
            $user = User::where('email', $request->email)->first();

            $organization = Organization::find($invitation->organization_id);
            $organization->users()->attach($user->id, ["invitation_id" => $invitation->id, "joined_at" => Carbon::now()]);

            Auth::loginUsingId($user->id);

            return redirect()->route('home')->with([
                "success" => "Votre compte a été créé et vous avez été ajouté à l'organisation $organization->name"
            ]);
        } else {
            User::create($userData);
            $user = User::where('email', $request->email)->first();

            Auth::loginUsingId($user->id);

            return redirect()->route('home')->with([
                "success" => "Votre compte a été créé"
            ]);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'));
    }
}
