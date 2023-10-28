<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Auth::user()->reservations;
        $data = [];

        foreach($reservations as $r){
            $data[] = [
                'id' => $r->id,
                'start' => $r->start,
                'stop' => $r->stop,
                'duration' => $r->duration(),
                'organisation' => $r->organization->name,
                'laundry' => $r->laundry->name,
                'machine' => $r->machine->name,
                'type' => [
                    'id' => $r->machine->type,
                    'name' => $r->machine->typeName()
                ],
            ];
        }

        return view("reservations.index",
            [
                "page" => "reservations",
                "pageTitle" => "Réservations",
                "pageDescription" => "Réservez une machine dans votre buanderie. Créez,
                    affichez et gérez vos réservations. Choisissez l'organisation, la buanderie, le type de machine, la date et
                    la durée. Consultez les disponibilités, affichez l'historique des réservations et supprimez les réservations
                    à venir.",
                "reservations" => $data
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("reservations.create", ["page" => "reservations",
            "pageTitle" => "Nouvelles réservations",
            "pageDescription" => "Créez,une réservation. Choisissez l'organisation, la buanderie, le type de machine, la date et
            la durée.",
            "reserving" => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
