<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("bookings.index", ["page" => "bookings",
            "pageTitle" => "Réservations", "pageDescription" => "Réservez une machine dans votre buanderie. Créez,
            affichez et gérez vos réservations. Choisissez l'organisation, la buanderie, le type de machine, la date et
            la durée. Consultez les disponibilités, affichez l'historique des réservations et supprimez les réservations
            à venir."]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("bookings.create", ["page" => "bookings",
            "pageTitle" => "Nouvelles réservations", "pageDescription" => "Créez,une réservation. Choisissez l'organisation, la buanderie, le type de machine, la date et
            la durée."]);
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
