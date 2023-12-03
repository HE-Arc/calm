<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laundry;
use App\Models\Machine;
use App\Models\Reservation;
use App\Utils\Paginate;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class LaundryController extends Controller
{
    public function index(string $orgId)
    {
        $organization = Auth::user()->organizations->find($orgId);

        if (empty($organization)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        $laundries = $organization->laundries;
        $laundries = Paginate::paginate(collect($laundries)->sortBy('name')->reverse()->toArray(), 5);

        return view(
            'management.laundries.index',
            [
                "page" => "laundries management index",
                "pageTitle" => "Laundries Management",
                "pageDescription" => "Gérez vos buandries",
            ],
            compact('laundries','orgId')
        );
    }

    public function show(string $orgId, string $id)
    {
        $organization = Auth::user()->organizations->find($orgId);
        $laundry = $organization->laundries->find($id);
        $machines = $laundry->machines;

        if (empty($organization)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }
        if (empty($laundry)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }


        return view(
            'management.laundries.show',
            [
                "page" => "laundries",
                "pageTitle" => "Laundries",
                "pageDescription" => "Gérez vos buandries",
            ],
            compact('laundry','machines')
        );
    }

    public function create(string $orgId)
    {
        return view(
            'management.laundries.create',
            [
                "page" => "laundries create",
                "pageTitle" => "Laundries Creation",
                "pageDescription" => "Créez votre buandrie",
            ],
            compact('orgId')
        );
    }


    public function store(Request $request, string $orgId)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);


        $organizations = Auth::user()->organizations;
        $organization = $organizations->find($orgId);

        if ($organization == null) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        if (Laundry::where('name', $request->name)->exists()) {
            return back()->withErrors(["Laundry already exists."])->withInput();
        }


        $organization->laundries()->create([
            'name' => $request->name,
            'description' => $request->description,
            'organization_id' => $orgId
        ]);

        return redirect()->route('management.laundries.index',$orgId)->with([
            'success' => 'Buandrie crée avec succes',
        ]);
    }

    public function edit(string $orgId, string $id)
    {
        $organization = Auth::user()->organizations->find($orgId);
        $laundry = $organization->laundries->find($id);
        $machines = $laundry->machines;

        if (empty($organization)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }
        if (empty($laundry)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }

        return view(
            'management.laundries.edit',
            [
                "page" => "laundries edit",
                "pageTitle" => "Edit laundries",
                "pageDescription" => "Modifier vos buandries",
            ],
            compact('laundry','machines')
        );
    }

    public function update(Request $request, string $orgId, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $organization = Auth::user()->organizations->find($orgId);
        if (!$organization->laundries->contains($id)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }

        $laundry = Laundry::find($id);

        $laundry->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('management.laundries.show',[$orgId, $id])->with([
            'success' => 'Buandrie mise à jour avec succes',
        ]);
    }

    public function destroy(string $orgId, string $id)
    {
        $organization = Auth::user()->organizations->find($_SESSION['orgId']);

        if (!$organization->laundries->contains($id)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }

        Laundry::find($id)->delete();

        return redirect()->route('management.laundries.index')->with([
            'success' => 'Buandrie supprimé avec succes',
        ]);
    }
}
