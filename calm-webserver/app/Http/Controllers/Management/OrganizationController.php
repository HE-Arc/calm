<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Laundry;
use App\Models\Machine;
use App\Models\Organization;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\Paginate;

class OrganizationController extends Controller
{

    public function index()
    {
        $organizations = Auth::user()->organizations;

        $organizations = Paginate::paginate(collect($organizations)->sortBy('name')->reverse()->toArray(), 5);

        return view(
            'management.organizations.index',
            [
                "page" => "organizations",
                "pageTitle" => "Organizations",
                "pageDescription" => "Gérez vos Organisations",
            ],
            compact('organizations')
        );
    }

    public function show(string $id)
    {
        if(!Auth::user()->organizations->contains($id)){
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        $organization = Organization::find($id);

        return view('management.organizations.show',[
            "page" => "organizations",
            "pageTitle" => "Organizations",
            "pageDescription" => "Gérez vos Organisations",
            "pageParent" => ["management.organizations.index"=>[]],
        ],
        compact('organization'));
    }

    public function create()
    {
        return view('management.organizations.create',
        [
            "page" => "organizations create",
            "pageTitle" => "Organizations Creation",
            "pageDescription" => "Créez votre organisation",
            "pageParent" => ["management.organizations.index"=>[]],
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:organizations,name',
        ]);

        Organization::create([
            'name' => $request->name,
        ])->users()->attach(Auth::user()->id);

        return redirect()->route('management.organizations.index')->with([
            'success' => 'Organisation créée avec succès',
        ]);
    }

    public function edit(string $id)
    {
        if (!Auth::user()->organizations->contains($id)) {
            return back()->withErrors(["L'organisation n'existe pas"])->withInput();
        }

        $organization = Organization::find($id);

        return view('management.organizations.edit',
        [
            "page" => "organizations edit",
            "pageTitle" => "Edit organizations",
            "pageDescription" => "Modifier vos Organisations",
            "pageParent" => ["management.organizations.index"=>[]],
        ],

        compact('organization'));
    }
    public function update(Request $request, string $id)
    {
        if (!Auth::user()->organizations->contains($id)) {
            return back()->withErrors(["L'organisation n'existe pas"])->withInput();
        }

        $request->validate([
            'name' => 'required',
        ]);

        Organization::find($id)->update([
            'name' => $request->name,

        ]);


        return redirect()->route('management.organizations.show', $id)->with([
            'success' => 'Organisation mise à jour avec succès',
        ]);
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->organizations->contains($id)) {
            return back()->withErrors(["L'organisation n'existe pas"])->withInput();
        }

        Organization::find($id)->delete();

        return redirect()->route('management.organizations.index')->with([
            'success' => 'Organisation supprimée avec succès',
        ]);
    }

}
