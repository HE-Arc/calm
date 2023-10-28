@extends('layout.app')
@section('content')
    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Réservations</h1>

    <div class="mx-auto text-center my-6">
        <a href="{{ route('reservations.create') }}" class="font-title text-center text-white font-medium bg-vividTangerine hover:bg-manhattan focus:ring-4 focus:ring-manhattan rounded-lg text-md px-5 py-2.5 focus:outline-none my-2">Ajouter une nouvelle réservation</a>
    </div>

    <div class="flex flex-col gap-4 items-center justify-center">
        @foreach($reservations as $reservation)
            <a class="rounded-sm w-1/2 grid grid-cols-12 bg-white shadow p-3 gap-2 items-center hover:shadow-lg transition delay-150 duration-300 ease-in-out hover:scale-105 transform" href="#">

                <!-- Icon -->
                <div class="col-span-12 md:col-span-1">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="20" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 2h4a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4m6 0v3H6V2m6 0a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1M5 5h8m-5 5h5m-8 0h.01M5 14h.01M8 14h5"/>
                    </svg>
                </div>

                <!-- Title -->
                <div class="col-span-11 xl:-ml-5">
                    <p class="text-blue-600 font-semibold">{{$reservation->organisation}}</p>
                </div>

                <!-- Description -->
                <div class="md:col-start-2 col-span-11 xl:-ml-5">
                    <ul class="mt-1 text-sm font-normal">
                        <li>Nom de l'organisation : </li>
                        <li>Nom de la buandrie : {{$reservation->laundry}}</li>
                        <li>Date : {{$reservation->duration}}</li>
                        <li>Machine :</li>
                    </ul>
                </div>

                <?php var_dump($reservation->machine); ?>

            </a>
        @endforeach

        {!! $reservations->links() !!}
    </div>
@endsection
