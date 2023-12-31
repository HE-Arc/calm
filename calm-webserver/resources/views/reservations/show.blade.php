@extends('layout.app')
@section('content')
    <article class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
        <div>
            <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Votre réservation</h1>
        </div>
        <div class="my-4">
            <p>Date</p>
            <div class="flex input input-sobre">
                <label class="flex-grow w-full">{{ $reservation->start->format('d F Y') }}</label>
                <span class="icons icons-sobre">calendar_month</span>
            </div>
        </div>
        <div class="flex flex-row">
            <div class="flex-grow w-full pr-4">
                <p>Heure de début</p>
                <div class="flex input input-sobre">
                    <label class="w-full">{{ $reservation->start->format('H:i') }}</label>
                    <span class="icons icons-sobre">schedule</span>
                </div>
            </div>
            <div class="flex-grow w-full pl-4">
                <p>Heure de fin</p>
                <div class="flex input input-sobre">
                    <label class="w-full">{{ $reservation->stop->format('H:i') }}</label>
                    <span class="icons icons-sobre">schedule</span>
                </div>
            </div>
        </div>
        <div class="my-4">
            <p>Machine selectionée</p>
            <div class="flex input input-sobre">
                <label class="w-full">{{ $reservation->machine->name }}</label>
                <span class="icons icons-sobre">text_fields</span>
            </div>
        </div>
        <div class="my-4">
            <p>Type de machine</p>
            <div class="flex input input-sobre">
                <label class="w-full">{{ $reservation->machine->typeName() }}</label>
                <span class="icons icons-sobre">text_fields</span>
            </div>
        </div>
        <div class="text-center">
            <form action="#" method="post" id="delete-reservation-form">
                @csrf
                @method('DELETE')
                <input onclick="event.preventDefault()" data-modal-target="reservation-delete-confirm-modal"
                    data-modal-show="reservation-delete-confirm-modal" type="submit"
                    class="btn btn-forte w-full mx-auto"
                    value="Supprimer...">
            </form>
        </div>
    </article>

    <x-modal>
        @slot('id', 'reservation-delete-confirm-modal')
        @slot('form', 'delete-reservation-form')
        @slot('icon', 'warning')
        @slot('confirm', 'Supprimer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Supprimer la reservation')
        <x-slot name="body">
            <p class="text-gray-500">Etes-vous sur de vouloir supprimer cette reservation ?</p>
        </x-slot>
    </x-modal>
@endsection
