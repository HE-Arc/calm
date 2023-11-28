<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private function getOrganization(string $orgID){
        $organization = Organization::findOrFail($orgID);
        if(!$organization->users->contains(Auth::user())){
            abort(404);
        } else {
            return $organization;
        }
    }

    public function index(string $orgID)
    {
        $organization = $this->getOrganization($orgID);
        $users = $organization->nonAdminUsers();

        //TODO call view
    }

    public function expel(string $orgID, string $userID){
        $organization = $this->getOrganization($orgID);
        $user = User::findOrFail($userID);

        // check if user is in organization
        if(!$organization->nonAdminUsers()->contains($user)) {
            abort(404);
        }

        // remove the user from the organization
        $organization->users()->detach($userID);

        return redirect()
            ->route('management.users.index', ['org' => $orgID])
            ->with([
                'success' => "L'utilisateur \"$user->name\" a été supprimé de l'organisation"
            ]);
    }

    public function add(string $orgID){
    }

    public function store(Request $request){
        $request->validate([
            'email' => ['required', 'email:rfc'],
            'organization' => ['required', 'integer'],
        ]);

        $email = $request->input('email');
        $orgID = $request->input('organization');

        $organization = $this->getOrganization($orgID);
        $user = User::whereEmail($email)->first();

        if(is_null($user)){
            return back()->withErrors([
                "L'utilisateur $email n'existe pas"
            ]);
        }

        if($user->is_admin){
            return back()->withErrors([
                "L'utilisateur $email ne peut pas être ajouté à cette organisation car c'est un administrateur"
            ]);
        }

        if($organization->nonAdminUsers()->contains($user)){
            return back()->withErrors([
                "L'utilisateur $email fait déjà partie de l'organisation $organization->name"
            ]);
        }

        $organization->users()->attach($user->id);

        return redirect()->route('management.users.index')->with([
            "success" => "Utilisateur $email a été ajouté à l'organisation $organization->name"
        ]);
    }
}
