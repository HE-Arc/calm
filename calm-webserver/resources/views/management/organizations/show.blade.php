@extends('layout.app')

@section('content')
    <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
        <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Détails de l'organisation</h1>

        <article class="flex flex-col gap-2">
            <label for="name">Nom de l'organisation</label>
            <div id="name" class="input input-sobre">
                <label>{{ $organization['name'] }}</label>
                <span class="icons icons-sobre">text_fields</span>
            </div>
            <a class="btn btn-sobre" href="{{ route('management.organizations.edit', $organization['id']) }}">Modifier</a>
            <div class="text-center">
                <form action="#" method="post" id="delete-organization-form">
                    @csrf
                    @method('DELETE')
                    <input onclick="event.preventDefault()" data-modal-target="organization-delete-confirm-modal"
                        data-modal-show="organization-delete-confirm-modal" type="submit"
                        class="btn btn-forte w-full mx-auto"
                        value="Supprimer...">
                </form>
            </div>
        </article>
    </section>

    <x-modal>
        @slot('id', 'organization-delete-confirm-modal')
        @slot('form', 'delete-organization-form')
        @slot('icon', 'warning')
        @slot('confirm', 'Supprimer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Supprimer l\'organisation')
        <x-slot name="body">
            <p class="text-gray-500">Etes-vous sur de vouloir supprimer cette organisation ?</p>
        </x-slot>
    </x-modal>
@endsection
