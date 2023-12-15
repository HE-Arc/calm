@extends('layout.app')

@section('content')
    <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
        <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Détails de la machine</h1>

        <article class="flex flex-col gap-2">
            <label for="name">Nom de la machine</label>
            <div id="name" class="input input-sobre">
                <label>{{ $machine['name'] }}</label>
                <span class="icons icons-sobre">text_fields</span>
            </div>
            <label for="description">Description de la machine</label>

            <div id="description" class="input input-sobre">
                <label>{{ $machine['description'] }}</label>
                <span class="icons icons-sobre">text_fields</span>
            </div>

            <label for="type">Type de la machine</label>

            <div id="type" class="input input-sobre">
                <label>{{ $machine['typeName'] }}</label>
                <span class="icons icons-sobre">text_fields</span>
            </div>

            <a class="btn btn-sobre"
                href="{{ route('management.machines.edit', [$orgId,$laundryId,$machine['id']]) }}">Modifier</a>
            <div class="text-center">
                <form action="{{ route('management.machines.destroy', [$orgId,$laundryId,$machine['id']]) }}"
                    method="post" id="delete-laundry-form">
                    @csrf
                    @method('DELETE')
                    <input onclick="event.preventDefault()" data-modal-target="laundry-delete-confirm-modal"
                        data-modal-show="laundry-delete-confirm-modal" type="submit" class="btn btn-forte w-full mx-auto"
                        value="Supprimer...">
                </form>
            </div>
        </article>
    </section>

    <x-modal>
        @slot('id', 'laundry-delete-confirm-modal')
        @slot('form', 'delete-laundry-form')
        @slot('icon', 'warning')
        @slot('confirm', 'Supprimer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Supprimer l\'machine')
        <x-slot name="body">
            <p class="text-gray-500">Êtes-vous sûr de vouloir supprimer cette machine ?</p>
        </x-slot>
    </x-modal>
@endsection
