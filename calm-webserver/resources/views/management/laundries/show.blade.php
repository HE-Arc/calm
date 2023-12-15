@extends('layout.app')

@section('content')
    <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
        <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Détails de la buanderie</h1>

        <article class="flex flex-col gap-2">
            <label for="name">Nom de la buanderie</label>
            <div id="name" class="input input-sobre">
                <label>{{ $laundry['name'] }}</label>
                <span class="icons icons-sobre">text_fields</span>
            </div>
            <label for="description">Description de la buanderie</label>
            <div id="description" class="input input-sobre">
                <label>{{ $laundry['description'] }}</label>
                <span class="icons icons-sobre">text_fields</span>
            </div>
            @if ($machines->count() > 0)
                <section class="">
                    <label for="machines">Machines de la buanderie</label>
                    <!-- Grid Container -->
                    <a href="{{ route('management.machines.index', [$laundry['organization_id'], $laundry['id']]) }}" class="grid grid-cols-1 border-2 border-rollingStone rounded-lg p-0 btn btn-transparent">
                        <div class="grid grid-cols-2 rounded-t bg-rollingStone text-white">
                            <div class="p-2">
                                <h2 class="text-lg font-semibold">Nom</h2>
                            </div>
                            <div class="p-2">
                                <h2 class="text-lg font-semibold">Type</h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 ">
                            @foreach ($machines as $machine)
                                <div class ="border-r-2 p-2 border-rollingStone">
                                    {{ $machine['name'] }}
                                </div>
                                <div class = "p-2">
                                    {{ $machine->typeName() }}
                                </div>
                            @endforeach
                        </div>

                    </a><!-- End Grid Container -->


                </section>
            @else
                <label for="machines">Aucune machine dans cette buanderie</label>
                <a href="{{ route('management.machines.index', [$laundry['organization_id'], $laundry['id']]) }}" class="btn btn-transparent">Gérérer les machines de la buanderie</a>
            @endif

            <a class="btn btn-sobre"
                href="{{ route('management.laundries.edit', [$laundry['organization_id'], $laundry['id']]) }}">Modifier</a>
            <div class="text-center">
                <form action="{{ route('management.laundries.destroy', [$laundry['organization_id'], $laundry['id']]) }}"
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
        @slot('header', 'Supprimer l\'buanderie')
        <x-slot name="body">
            <p class="text-gray-500">Êtes-vous sûr de vouloir supprimer cette buanderie ?</p>
        </x-slot>
    </x-modal>
@endsection
