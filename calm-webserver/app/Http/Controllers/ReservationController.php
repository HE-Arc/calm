<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\Reservation;
use App\Models\Organization;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\Paginate;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Carbon;
class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Auth::user()->reservations;
        $data = [];

        foreach ($reservations as $r) {
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

        $reservations = Paginate::paginate(collect($data)->sortBy('start')->reverse()->toArray(), 2);

        return view(
            "reservations.index",
            [
                "page" => "reservations",
                "pageTitle" => "Réservations",
                "pageDescription" => "Réservez une machine dans votre buanderie. Créez,
                    affichez et gérez vos réservations. Choisissez l'organisation, la buanderie, le type de machine, la date et
                    la durée. Consultez les disponibilités, affichez l'historique des réservations et supprimez les réservations
                    à venir.",
            ],
            compact('reservations')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizations = [];

        foreach(Auth::user()->organizations as $org){
            $laundries = [];
            foreach($org->laundries as $laudry) {
                $laundries[] = [
                    'id' => $laudry->id,
                    'name' => $laudry->name,
                    'description' => $laudry->description
                ];
            }

            $organizations[] = [
                'id' => $org->id,
                'name' => $org->name,
                'laundries' => $laundries
            ];
        }


        return view("reservations.create", ["page" => "reservations",
            "pageTitle" => "Nouvelles réservations",
            "pageDescription" => "Créez,une réservation. Choisissez l'organisation, la buanderie, le type de machine, la date et
            la durée.",
            "reserving" => false,
            'organizations' => $organizations
        ]);
    }

    public function choose(Request $request){
        $param = $request->validate([
            'laundry' => ['required', 'integer'],
            'day' => ['required', 'date'],
            'duration' => ['required', 'integer', 'min:30', 'max:360'],
            'type' => ['required', 'in:wash,dry'],
            ]);

        $laundry = Laundry::find($param['laundry']);
        $user = Auth::user();
        $date = new Carbon($param['day']);
        $duration = intval($param['duration']);


        $reservations = [];
        foreach(Reservation::find_reservations($date, $duration, $user, $laundry, $param['type']) as $r){
            $reservations[] = [
                'id' => -1,
                'machine' => $r->machine->name,
                'description' => $r->machine->description,
                'start' => $r->start,
                'stop' => $r->stop,
            ];
        }

        $param = [
            'organization' => $laundry->organization->name,
            'laundry' => $laundry->name,
            'date' => $date,
            'type' => [
                'id' => $param['type'],
                'name' => ($param['type'] == 'wash') ? 'Lavage' : 'Séchage'
            ],
            'reservations' => $reservations
        ];

        return view('reservations.create', [
            "page" => "Reservation",
            "pageTitle" => "Choix d'une réservation",
            "pageDescription" => "Choisissez une réservation parmi les propositions.",
            "reserving" => true,
            "proposition" => $param
        ]);
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
        $reservation = Reservation::find($id);

        return view(
            "reservations.show",
            [
                "page" => "reservations",
                "pageTitle" => "Details de la réservation",
                "pageDescription" => "Affiche les details de la reservation",
                "reservation" => $reservation
            ],
        );
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
