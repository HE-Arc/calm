<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laundry;
use App\Utils\Paginate;
use Illuminate\Support\Facades\Auth;

class LaundryController extends Controller
{
    public function index(string $orgId)
    {
        $organization = Auth::user()->organizations->find($orgId);

        if (empty($organization)) {
            return back()->withErrors(["Cette organisation n'existe pas"])->withInput();
        }

        $laundries = Paginate::paginate($organization->laundries);

        return view(
            'management.laundries.index',
            [
                "page" => "laundries management index",
                "pageTitle" => "Laundries Management",
                "pageDescription" => "Gérez vos buandries",
                "pageParent" => ["management.organizations.index" => []],
                "laundries" => $laundries,
                "org" => $organization
            ],
        );
    }

    public function show(string $orgId, string $id)
    {
        $organization = Auth::user()->organizations->find($orgId);
        if (empty($organization)) {
            return back()->withErrors(["L'organisation n'existe pas"])->withInput();
        }
        $laundry = $organization->laundries->find($id);
        if (empty($laundry)) {
            return back()->withErrors(["La buanderie n'existe pas"])->withInput();
        }
        $machines = $laundry->machines;



        return view(
            'management.laundries.show',
            [
                "page" => "laundries",
                "pageTitle" => "Laundries",
                "pageDescription" => "Gérez vos buandries",
                "pageParent" => ["management.laundries.index" => [$orgId]],
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
                "pageParent" => ["management.organizations.index" => []],
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
            return back()->withErrors(["L'organisation n'existe pas"])->withInput();
        }

        if ($organization->laundries->where('name', $request->name)->isNotEmpty()) {
            return back()
                ->withErrors(["Une buanderie avec le même nom existe déjà dans cette organisation"])
                ->withInput();
        }


        $organization->laundries()->create([
            'name' => $request->name,
            'description' => $request->description,
            'organization_id' => $orgId
        ]);

        return redirect()->route('management.laundries.index',$orgId)->with([
            'success' => 'Buanderie créée avec succès',
        ]);
    }

    public function edit(string $orgId, string $id)
    {
        $organization = Auth::user()->organizations->find($orgId);
        if (empty($organization)) {
            return back()->withErrors(["L'organisation n'existe pas"])->withInput();
        }
        $laundry = $organization->laundries->find($id);
        if (empty($laundry)) {
            return back()->withErrors(["La buanderie n'existe pas"])->withInput();
        }
        $machines = $laundry->machines;

        return view(
            'management.laundries.edit',
            [
                "page" => "laundries edit",
                "pageTitle" => "Edit laundries",
                "pageDescription" => "Modifier vos buandries",
                "pageParent" => ["management.laundries.index" => [$orgId]],
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
            return back()->withErrors(["La buanderie n'existe pas"])->withInput();
        }

        $laundry = Laundry::find($id);

        $laundry->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('management.laundries.show',[$orgId, $id])->with([
            'success' => 'Buanderie mise à jour avec succès',
        ]);
    }

    public function destroy(string $orgId, string $id)
    {
        if (!Auth::user()->organizations->contains($orgId)) {
            return back()->withErrors(["L'organisation n'existe pas"])->withInput();
        }

        $organization = Auth::user()->organizations->find($orgId);

        if (!$organization->laundries->contains($id)) {
            return back()->withErrors(["La buanderie n'existe pas"])->withInput();
        }

        Laundry::find($id)->delete();

        return redirect()->route('management.laundries.index',$orgId)->with([
            'success' => 'Buanderie supprimée avec succès',
        ]);
    }
}
