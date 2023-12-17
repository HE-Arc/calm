<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Organization;
use App\Utils\Paginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function index(string $id)
    {
        $organization = Auth::user()->organizations->find($id);
        if(empty($organization)){
            return back()->withErrors(["Cette organisation n'existe pas"]);
        }

        $invitations = $organization->invitations;

        return view('management.invitation.index', [
            "page" => "Invitations index",
            "pageTitle" => "Invitations",
            "pageDescription" => "Gérer les invitations de l'organisation $organization->name",
            "pageParent" => ["management.organizations.index"=>[]],
            "invitations" => Paginate::paginate($invitations),
            "org" => $organization
        ]);
    }

    public function disable(string $invitationId){
        $invitation = Invitation::findOrFail($invitationId);

        if(empty(Auth::user()->organizations->find($invitation->organization->id))){
            return back()->withErrors(["L'invitation n'existe pas"]);
        }

        if(!$invitation->is_active){
            return back()->withErrors(["L'invitation est déjà désactivée"]);
        }

        if($invitation->userCount() == 0){
            $invitation->delete();

            return back()->with([
                "success" => "Invitation supprimée"
            ]);
        } else {
            $invitation->is_active = false;
            $invitation->save();

            return back()->with([
                "success" => "Invitation désactivée"
            ]);
        }
    }

    public function enable(string $invitationId){
        $invitation = Invitation::findOrFail($invitationId);

        if(empty(Auth::user()->organizations->find($invitation->organization->id))){
            return back()->withErrors(["L'invitation n'existe pas"]);
        }

        if($invitation->is_active){
            return back()->withErrors(["L'invitation est déjà activée"]);
        }

        $invitation->is_active = true;
        $invitation->save();

        return back()->with([
            "success" => "Invitation réactivée"
        ]);
    }

    public function create(string $orgId){
        if(empty(Auth::user()->organizations->find($orgId))){
            return back()->withErrors(["L'organisation n'existe pas"]);
        }

        $invitation = Invitation::create($orgId);
        $invitation->save();

        return back()->with([
            "success" => "Nouvelle invitation créée avec le code $invitation->code"
        ]);
    }

    public function joinView()
    {
        return view('management.invitation.join', [
            "page" => "jointOrganization",
            "pageTitle" => "Invitations",
            "pageDescription" => "Rejoindre une organisation",
        ]);
    }

    public function processJoin(Request $request)
    {
        $request->validate([
            'code' => ['required', 'alpha_num:ascii']
        ]);

        if(!Invitation::where('code', $request['code'])->exists())
        {
            return back()->withErrors([
                "Le code n'existe pas ou n'est pas valide !"
            ])->withInput([
                'code' => $request['code'],
            ]);
        }

        $invitation = Invitation::where('code', $request['code'])->firstOrFail();
        $organization = Organization::find($invitation->organization_id);
        $user = Auth::user();

        if($organization->users->contains($user)){
            return back()->withErrors([
                "Vous faites déjà parti de l'organisation $organization->name"
            ]);
        }

        $organization->users()->attach($user->id);

        return redirect()->route('home', $organization->id)->with([
            "success" => "Vous avez été ajouté à l'organisation $organization->name"
        ]);
    }
}
