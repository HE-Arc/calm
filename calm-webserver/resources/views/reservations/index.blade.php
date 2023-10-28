@extends('layout.app')
@section('content')
    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Réservations</h1>

    <div class="mx-auto text-center my-6">
        <a href="{{ route('reservations.create') }}" class="font-title text-center text-white font-medium bg-vividTangerine hover:bg-manhattan focus:ring-4 focus:ring-manhattan rounded-lg text-md px-5 py-2.5 focus:outline-none my-2">Ajouter une nouvelle réservation</a>
    </div>
@endsection
