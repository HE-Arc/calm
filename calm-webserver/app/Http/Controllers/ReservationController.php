<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\Reservation;
use App\Models\Organization;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
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

        $reservations = Paginate::paginate(collect($data)->sortBy('start')->reverse()->toArray(), 5);

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
            foreach($org->laundries as $laundry) {
                $laundries[] = [
                    'id' => $laundry->id,
                    'name' => $laundry->name,
                    'description' => $laundry->description
                ];
            }

            $organizations[] = [
                'id' => $org->id,
                'name' => $org->name,
                'laundries' => $laundries
            ];
        }


        return view("reservations.create", ["page" => "reservations",
            "pageTitle" => "Nouvelle réservation",
            "pageDescription" => "Créez,une réservation. Choisissez l'organisation, la buanderie, le type de machine, la date et
            la durée.",
            "reserving" => false,
            'organizations' => $organizations
        ]);
    }

    /**
     * Creates paginator for reservation choice
     * Source : https://www.itsolutionstuff.com/post/how-to-create-pagination-from-array-in-laravelexample.html
     * @param array $items
     * @param int $item_per_page
     * @param $page
     * @param $options
     * @return LengthAwarePaginator
     */
    private function choice_paginator(array $items, int $item_per_page, $page=null,$options=[]){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $paginator = new LengthAwarePaginator($items->forPage($page, $item_per_page), $items->count(), $item_per_page, $page, $options);
        $paginator->setPath("/reservations/choose");
        return $paginator;
    }

    public function search_propositions(Request $request){
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

        $request->session()->put('laundry', $laundry);
        $request->session()->put('date', $date);
        $request->session()->put('type', $param['type']);

        $reservations = [];
        $i = 0;
        foreach(Reservation::find_reservations($date, $duration, $user, $laundry, $param['type']) as $r){
            $reservations[$i] = $r;
            $i++;
        }
        $request->session()->put('reservations', $reservations);

        return redirect('/reservations/choose');
    }

    public function show_propositions(Request $request){
        $reservations = $request->session()->get('reservations');
        $laundry = $request->session()->get('laundry');
        $type = $request->session()->get('type');
        $date = $request->session()->get('date');

        $param = [
            'organization' => $laundry->organization->name,
            'laundry' => $laundry->name,
            'date' => $date,
            'type' => [
                'id' => $type,
                'name' => ($type == 'wash') ? 'Lavage' : 'Séchage'
            ],
            'reservations' => $this->choice_paginator($reservations, 10, $request['page']),
        ];
        return view('reservations.create', [
            "page" => "reservations",
            "pageTitle" => "Choix d'une réservation",
            "pageDescription" => "Choisissez une réservation parmi les propositions.",
            "proposition" => $param
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $param = $request->validate([
            'id' => 'required'
        ]);
        $id = $param['id'];
        if(!$request->session()->exists('reservations')){
            return back()->withErrors(['Invalid request. Please retry']);
        }
        $reservations = $request->session()->get('reservations');
        if(!array_key_exists($id, $reservations)){
            return back()->withErrors(['Invalid ID. Please retry']);
        }

        $res_data = $reservations[$id];
        $res = new Reservation();
        $res->machine_id = $res_data->machine_id;
        $res->user_id = Auth::user()->id;
        $res->start = $res_data->start;
        $res->stop = $res_data->stop;

        $res->save();
        $res->fresh();

        return redirect('/reservations/' . $res->id);
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
        $res = Reservation::find($id);
        $res->delete();
        return redirect('/reservations');
    }
}
