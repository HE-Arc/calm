@extends('layout.app')
@section('content')
    <article class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
        <div class="flex flex-col items-end">
            <a href="{{ route('reservations.index') }}">
                <span class="material-symbols-rounded text-rollingStone">close</span>
            </a>
        </div>
        <div>
            <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Votre réservation</h1>
        </div>
        <div class="my-4">
            <p>Date</p>
            <div class="flex border-2 border-rollingStone rounded-lg p-2">
                <p class="grow w-full">{{ $reservation->start->format('d F Y') }}</p>
                <span class="material-symbols-rounded text-rollingStone">calendar_month</span>
            </div>
        </div>
        <div class="flex flex-row class="my-4"">
            <div class="flex-grow w-full pr-4">
                <p>Heure de début</p>
                <div class="flex border-2 border-rollingStone rounded-lg p-2">
                    <p class="w-full">{{ $reservation->start->format('H:i') }}</p>
                    <span class="material-symbols-rounded text-rollingStone">schedule</span>
                </div>
            </div>
            <div class="flex-grow w-full pl-4">
                <p>Heure de fin</p>
                <div class="flex border-2 border-rollingStone rounded-lg p-2">
                    <p class="w-full">{{ $reservation->stop->format('H:i') }}</p>
                    <span class="material-symbols-rounded text-rollingStone">schedule</span>
                </div>
            </div>
        </div>
        <div class="my-4">
            <p>Machine selectionée</p>
            <div class="flex border-2 border-rollingStone rounded-lg p-2">
                <p class="w-full">{{ $reservation->machine->name }}</p>
                <span class="material-symbols-rounded text-rollingStone">text_fields</span>
            </div>
        </div>
        <div class="my-4">
            <p>Type de machine</p>
            <div class="flex border-2 border-rollingStone rounded-lg p-2">
                <p class="w-full">{{ $reservation->machine->typeName() }}</p>
                <span class="material-symbols-rounded text-rollingStone">text_fields</span>
            </div>
        </div>
        <div class="text-center">
            <form action="#" method="post" id="delete-reservation-form">
                @csrf
                @method('DELETE')
                <input onclick="event.preventDefault()" data-modal-target="reservation-delete-confirm-modal"
                    data-modal-show="reservation-delete-confirm-modal" type="submit"
                    class="w-full mx-auto rounded-lg bg-vividTangerine hover:bg-manhattan text-white font-medium px-5 py-2.5 cursor-pointer"
                    value="Supprimer">
            </form>
        </div>
    </article>

    <x-modal>
        @slot('id', 'reservation-delete-confirm-modal')
        @slot('form', 'delete-reservation-form')
        @slot('icon', 'warning')
        @slot('confirm', 'Supprimer')
        @slot('close', 'Annuler')
        @slot('header', 'Supprimer la reservation')
        <x-slot name="body">
            <p class="text-gray-500">Etes-vous sur de vouloir supprimer cette reservation ?</p>
        </x-slot>
    </x-modal>
@endsection
