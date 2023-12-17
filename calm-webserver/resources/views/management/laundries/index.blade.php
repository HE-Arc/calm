@extends('layout.app')
@section('content')
    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Gestion des buanderies</h1>

    <section class="flex flex-col gap-4 items-center justify-center">
        <article class="overflow-x-auto w-full shadow-md sm:rounded-lg">
            <table class="table-auto w-full">
                <caption class="p-5 text-justify dark:text-white dark:bg-gray-800">
                    <div class="mx-auto mt-2 text-right">
                        <a href="{{ route('management.laundries.create', $org->id) }}" class="btn btn-forte">Créer une
                            nouvelle buanderie</a>
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
                            Gestion des Machines
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
                    @if ($laundries->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 lg:py-4 text-center font-medium text-gray-900">Aucune buanderie n'a été créée</td>
                        </tr>
                    @else
                        @foreach ($laundries as $laundry)
                            <tr>
                                <td data-title="Nom" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                    {{ $laundry->name }}
                                </td>
                                <td data-title="Description" class="px-6 py-4 text-center">
                                    {{ $laundry->description }}
                                </td>
                                <td data-title="Gestion des Machines" class="px-6 py-4 text-center">
                                    <a href="{{ route('management.machines.index', [$laundry->organization->id, $laundry->id]) }}"
                                        class="btn btn-transparent flex justify-center">
                                        <span class ="icons icons-sobre">oven_gen</span>
                                    </a>
                                </td>


                                <td data-title="Modifier" class="px-6 py-4 text-center">
                                    <a href="{{ route('management.laundries.edit', [$laundry->organization->id, $laundry->id]) }}"
                                        class="btn btn-transparent flex justify-center">
                                        <span class ="icons icons-sobre">edit_note</span>
                                    </a>
                                </td>
                                <td data-title="Détails" class="px-6 py-4 text-center">
                                    <a href="{{ route('management.laundries.show', [$laundry->organization->id, $laundry->id]) }}"
                                        class="btn btn-transparent flex justify-center">
                                        <span class ="icons icons-sobre">page_info</span>
                                    </a>
                                </td>

                                <td data-title="Supprimer" class="px-6 py-4 text-center">
                                    <!-- Route to delete user reservation -->
                                    <button type="submit"
                                        class="btn btn-transparent flex w-full justify-center btn-admin-delete-laundry"
                                        data-modal-target="delete-laundry-modal"
                                        data-modal-show="delete-laundry-modal"
                                        data-organization-id="{{ $org->id }}"
                                        data-laundry-id="{{ $laundry->id }}">
                                        <span class ="icons icons-forte">delete</span>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="flex justify-center p-2">
                {{ $laundries->links() }}
            </div>
        </article>
    </section>

    <x-modal>
        @slot('id', 'delete-laundry-modal')
        @slot('form', 'delete-laundry-form')
        @slot('icon', 'warning')
        @slot('confirm', 'Supprimer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Supprimer la buanderie')
        <x-slot name="body">
            <form id="delete-laundry-form" action="" method="post">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="">

                <p class="text-gray-500"><strong>!!! ATTENTION !!! </strong> Vous êtes sur le point de
                    <strong>DÉFINITIVEMENT</strong> supprimer cet buanderie ! <br>
                    Cette action est <strong>IRRÉVERSIBLE</strong> ! La buanderie sera définitivement supprimée !
                    <br>
                    <strong>
                        Êtes-vous sûr de vouloir continuer ?
                    </strong>
                </p>
            </form>
        </x-slot>
    </x-modal>
@endsection
