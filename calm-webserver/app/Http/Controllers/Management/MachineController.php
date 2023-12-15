<?php

namespace App\Http\Controllers\Management;

use App\Models\Laundry;
use App\Models\Machine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Utils\Paginate;
use Illuminate\Http\Request;

class MachineController extends Controller
{

    public function index(string $orgId, string $laundryId)
    {
        $organization = Auth::user()->organizations->find($orgId);

        if (empty($organization)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        $laundry = Laundry::with('machines')->find($laundryId);

        if (empty($laundry)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }


        $machines = $laundry->machines;

        $machines = $machines->map(function ($machine) {
            $machine->typeName = $machine->typeName();
            return $machine;
        });

        $machines = Paginate::paginate(collect($machines)->sortBy('name')->reverse()->toArray(), 5);

        return view(
            'management.machines.index',
            [
                "page" => "machines management index",
                "pageTitle" => "Machines Management",
                "pageDescription" => "Gérez vos machines",
            ],
            compact('machines', 'orgId', 'laundryId')
        );
    }

    public function show(string $orgId, string $laundryId, string $id)
    {
        $organization = Auth::user()->organizations->find($orgId);
        if (empty($organization)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        $laundry = Laundry::with('machines')->find($laundryId);
        if (empty($laundry)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }

        $machine = $laundry->machines->find($id);
        if (empty($machine)) {
            return back()->withErrors(["This Machine does not exist for this organization."])->withInput();
        }

        $machine->typeName = $machine->typeName();

        return view(
            'management.machines.show',
            [
                "page" => "machines management show",
                "pageTitle" => "Machines Management",
                "pageDescription" => "Gérez vos machines",

            ],
            compact('machine', 'orgId', 'laundryId')
        );
    }

    public function create(string $orgId, string $laundryId)
    {
        $types = ['dry' => 'Sechage', 'wash' => 'Lavage'];
        return view(
            'management.machines.create',
            [
                "page" => "machine create",
                "pageTitle" => "Machine Creation",
                "pageDescription" => "Créez votre machine",
            ],
            compact('types', 'orgId', 'laundryId')
        );
    }

    public function store(Request $request, string $orgId, string $laundryId)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);

        $organizations = Auth::user()->organizations;
        $organization = $organizations->find($orgId);

        if ($organization == null) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        $laundry = $organization->laundries->find($laundryId);

        if ($laundry == null) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }

        $laundry->machines()->create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'laundry_id' => $laundryId
        ]);

        return redirect()->route('management.machines.index', [$orgId, $laundryId])->with([
            'success' => 'Machine crée avec succes',
        ]);
    }


    public function edit(string $orgId, string $laundryId, string $id)
    {
        $types = ['dry' => 'Sechage', 'wash' => 'Lavage'];
        $organization = Auth::user()->organizations->find($orgId);
        if (empty($organization)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        $laundries = $organization->laundries;
        $laundry = $laundries->find($laundryId);
        if (empty($laundry)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }

        $machine = $laundry->machines->find($id);
        if (empty($machine)) {
            return back()->withErrors(["This Machine does not exist for this organization."])->withInput();
        }

        $machine->typeName = $machine->typeName();

        $laundries = $laundries->map(function ($laundry) {
            return [
                'id' => $laundry->id,
                'name' => $laundry->name
            ];
        });

        return view(
            'management.machines.edit',
            [
                "page" => "machines management show",
                "pageTitle" => "Machines Management",
                "pageDescription" => "Gérez vos machines",

            ],
            compact('laundries', 'machine', 'types', 'orgId', 'laundryId')
        );
    }


    public function update(Request $request, string $orgId, string $laundryId, string $id)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'laundry_id' => 'required',
        ]);

        $organization = Auth::user()->organizations->find($orgId);
        if (!$organization->laundries->contains($laundryId)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }

        $laundry = Laundry::find($laundryId);
        if (empty($laundry)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }

        $machine = $laundry->machines->find($id);

        if (empty($machine)) {
            return back()->withErrors(["This Machine does not exist for this organization."])->withInput();
        }

        if ($request->laundry_id != $laundryId) {
            Machine::find($id)->delete();
            Laundry::find($request->laundry_id)->machines()->create([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
            ]);

            return redirect()->route('management.machines.index',[$orgId, $laundryId])->with([
                'success' => 'Machine a été déplacer et mise à jour avec succes',
            ]);
        } else {
            $machine->update([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
            ]);
            return redirect()->route('management.machines.show', [$orgId, $laundryId, $id])->with([
                'success' => 'Machine mise à jour avec succes',
            ]);
        }
    }
    public function destroy(string $orgId, string $laundryId, string $id)
    {
        if (!Auth::user()->organizations->contains($orgId)) {
            return back()->withErrors(["Permission denied for this organization."])->withInput();
        }

        $organization = Auth::user()->organizations->find($orgId);

        if (!$organization->laundries->contains($laundryId)) {
            return back()->withErrors(["This Laundry does not exist for this organization."])->withInput();
        }

        Machine::find($id)->delete();

        return redirect()->route('management.laundries.show', [$orgId, $laundryId])->with([
            'success' => 'Machine supprimé avec succes',
        ]);
    }
}
