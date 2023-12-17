@extends('layout.app')
@section('content')
    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Gestion des machines dans {{$laundry->name}}</h1>

    <article class="overflow-x-auto w-full shadow-md sm:rounded-lg">
        <table class="table-auto w-full">
            <caption class="p-5 text-justify dark:text-white dark:bg-gray-800">
                <div class="mx-auto mt-2 text-right">
                    <a href="{{ route('management.machines.create', [$orgId, $laundryId]) }}" class="btn btn-forte">Créer une
                        nouvelle Machine</a>
                </div>
            </caption>
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modifier
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Détails
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Supprimer
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($machines->isEmpty())
                    <tr>
                        <td colspan="5" class="px-6 lg:py-4 text-center font-medium text-gray-900">Aucune buanderie n'a
                            été créée</td>
                    </tr>
                @else
                    @foreach ($machines as $machine)
                        <tr>
                            <td data-title="Nom" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                {{ $machine->name }}
                            </td>
                            <td data-title="Description" class="px-6 py-4 text-center">
                                {{ $machine->description }}
                            </td>
                            <td data-title="Type" class="px-6 py-4 text-center">
                                    {{ $machine->typeName() }}
                            </td>
                            <td data-title="Modifier" class="px-6 py-4 text-center">
                                <a href="{{ route('management.machines.edit', [$organization->id, $laundry->id, $machine->id]) }}"
                                    class="btn btn-transparent flex justify-center">
                                    <span class ="icons icons-sobre">edit_note</span>
                                </a>
                            </td>
                            <td data-title="Détails" class="px-6 py-4 text-center">
                                <a href="{{ route('management.machines.show', [$organization->id, $laundry->id, $machine->id]) }}"
                                    class="btn btn-transparent flex justify-center">
                                    <span class ="icons icons-sobre">page_info</span>
                                </a>
                            </td>

                            <td data-title="Supprimer" class="px-6 py-4 text-center">
                                <!-- Route to delete user reservation -->
                                <button type="submit"
                                    class="btn btn-transparent flex w-full justify-center btn-admin-delete-machine"
                                    data-modal-target="delete-machine-modal"
                                    data-modal-show="delete-machine-modal"
                                    data-organization-id="{{ $organization->id }}"
                                    data-laundry-id="{{ $laundry->id }}"
                                    data-machine-id="{{ $machine->id }}">
                                    <span class ="icons icons-forte">delete</span>
                                </button>
                            </td>

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="flex justify-center p-2">
            {{ $machines->links() }}
        </div>
    </article>

    <x-modal>
        @slot('id', 'delete-machine-modal')
        @slot('form', 'delete-machine-form')
        @slot('icon', 'warning')
        @slot('confirm', 'Supprimer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Supprimer la machine')
        <x-slot name="body">
            <form id="delete-machine-form" action="" method="post">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="">

                <p class="text-gray-500">Vous êtes sur le point de supprimer cette machine.
                    <br>

                    <strong>
                        Êtes-vous sûr de vouloir continuer ?
                    </strong>
                </p>
            </form>
        </x-slot>
    </x-modal>
@endsection
