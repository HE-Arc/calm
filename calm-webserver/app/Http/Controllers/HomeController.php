<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', ['pageTitle' => "Accueil",
        'pageDescription' => "Capable and Accessible Laundry Manager (CALM) est une application web permettant la
        gestion de buanderies dans les immeubles locatifs. Elle proposerait en particulier la planification horaire et
        la gestion des réservations."]);
    }
}
