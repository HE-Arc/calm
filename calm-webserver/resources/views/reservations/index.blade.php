@extends('layout.app')
@section('content')
    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Réservations</h1>

    <div class="mx-auto text-center my-6">
        <a href="{{ route('reservations.create') }}" class="font-title text-center text-white font-medium bg-vividTangerine hover:bg-manhattan focus:ring-4 focus:ring-manhattan rounded-lg text-md px-5 py-2.5 focus:outline-none my-2">Ajouter une nouvelle réservation</a>
    </div>

    <div class="flex flex-col gap-4 items-center justify-center">
    @if(count($reservations) === 0)
        <div class="flex items-center justify-center">
            <p class="mt-10">Aucune réservation prévue.</p>
        </div>
    @else
        @foreach($reservations as $reservation)
            <a href="{{ route('reservations.show', $reservation['id']) }}" class="w-full rounded-sm md:w-1/2 grid grid-cols-12 bg-white shadow p-3 gap-2 items-center hover:shadow-lg transition delay-150 duration-300 ease-in-out hover:scale-105 transform">
                <!-- Icon -->
                <div class="col-span-12 md:col-span-1">
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="20" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 2h4a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4m6 0v3H6V2m6 0a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1M5 5h8m-5 5h5m-8 0h.01M5 14h.01M8 14h5"/>
                    </svg>
                </div>

                <!-- Title -->
                <div class="col-span-11 xl:-ml-5">
                    <p class="font-semibold text-rollingStone">{{$reservation["type"]["name"]}} sur la machine {{$reservation["machine"]}} de {{ $reservation["start"]->format('H:i') }} à {{ $reservation["stop"]->format('H:i')}}</p>
                </div>

                <!-- Description -->
                <div class="md:col-start-2 col-span-11 xl:-ml-5">
                    <ul class="mt-1 text-sm font-normal">
                        <li>Organisation : {{$reservation["organisation"]}}</li>
                        <li>Buandrie : {{$reservation["laundry"]}}</li>
                        <li>Horaire : {{ $reservation["start"]->format('H:i') }} à {{ $reservation["stop"]->format('H:i')}}</li>
                        <li>Date : {{$reservation["start"]->format('d.m.Y')}}</li>
                        <li>Durée : {{$reservation["duration"]}} min</li>
                    </ul>
                </div>
            </a>
        @endforeach

        {{ $reservations->links() }}
    @endif
    </div>
@endsection
