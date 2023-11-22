<?php

namespace App\Http\Controllers\management;

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
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);


        if (Organization::where('name', $request->name)->exists()) {
            return back()->withErrors(["Organization already exists."])->withInput();
        }

        Auth::user()->organizations()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('management.organizations.index')->with([
            'success' => 'Organisation crée avec succes',
        ]);
    }

    public function edit(string $id)
    {
        if (!Auth::user()->organizations->contains($id)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        $organization = Organization::find($id);

        return view('management.organizations.edit',
        [
            "page" => "organizations edit",
            "pageTitle" => "Edit organizations",
            "pageDescription" => "Modifier vos Organisations",
        ],

        compact('organization'));
    }
    public function update(Request $request, string $id)
    {
        if (!Auth::user()->organizations->contains($id)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        $request->validate([
            'name' => 'required',
        ]);

        Organization::find($id)->update([
            'name' => $request->name,

        ]);


        return redirect()->route('management.organizations.show', $id)->with([
            'success' => 'Organisation mise à jour avec succes',
        ]);
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->organizations->contains($id)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        Organization::find($id)->delete();

        return redirect()->route('management.organizations.index')->with([
            'success' => 'Organisation supprimé avec succes',
        ]);
    }

}
