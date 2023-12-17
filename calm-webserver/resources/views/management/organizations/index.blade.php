@extends('layout.app')
@section('content')
    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Gestion des organisations</h1>
    <section class="flex flex-col gap-4 items-center justify-center">
        <article class=" overflow-x-auto w-full shadow-md sm:rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-justify dark:text-white dark:bg-gray-800">
                    <div class="mx-auto mt-2 text-right">
                        <a href="{{ route('management.organizations.create') }}" class="btn btn-forte">Créer une nouvelle
                            organisation</a>
                    </div>
                </caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3">
                            Nom
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Geston des buanderies
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Gestion des utilisateurs
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Gestoin des invitations
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
                    @if ($organizations->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                Aucune Organisation n'a été créée
                            </td>
                        </tr>
                    @else
                        @foreach ($organizations as $organization)
                            <tr>
                                <td data-title="Nom" class="px-6 lg:py-4 text-center font-medium">
                                    {{ $organization['name'] }}
                                </td>
                                <td data-title="Gérer les buanderies" class="px-6 py-4 text-center">
                                    <a href="{{ route('management.laundries.index', $organization['id']) }}"
                                        class="btn btn-transparent flex justify-center">
                                        <span class ="icons icons-sobre">laundry</span>
                                    </a>
                                </td>
                                <td data-title="Gérer les utilisateurs" class="px-6 py-4 text-center">
                                    <a href="{{ route('management.users.index', $organization['id']) }}"
                                        class="btn btn-transparent flex justify-center">
                                        <span class ="icons icons-sobre">groups</span>
                                    </a>
                                </td>

                                <!-- TODO Link to right route (web.php) -->
                                <td data-title="Gestion des invitations" class="px-6 py-4 text-center">
                                    <a href="{{ route('invitation.index', $organization['id']) }}"
                                     class="btn btn-transparent flex justify-center">
                                        <span class ="icons icons-sobre">person_add</span>
                                    </a>
                                </td>

                                <td data-title="Modifier" class="px-6 py-4 text-center">
                                    <a href="{{ route('management.organizations.edit', $organization['id']) }}"
                                        class="btn btn-transparent flex justify-center">
                                        <span class ="icons icons-sobre">edit_note</span>
                                    </a>
                                </td>

                                <td data-title="Détails" class="px-6 py-4 text-center">
                                    <a href="{{ route('management.organizations.show', $organization['id']) }}"
                                        class="btn btn-transparent flex justify-center">
                                        <span class ="icons icons-sobre">page_info</span>
                                    </a>
                                </td>

                                <td data-title="Supprimer" class="px-6 py-4 text-center">
                                    <!-- Route to delete user reservation -->
                                    <button type="submit"
                                        class="btn btn-transparent flex w-full justify-center btn-admin-delete-organization"
                                        data-modal-target="delete-organization-modal"
                                        data-modal-show="delete-organization-modal"
                                        data-organization-id="{{ $organization['id'] }}">
                                        <span class ="icons icons-forte">delete</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="flex justify-center p-2">
                {{ $organizations->links() }}
            </div>
        </article>
    </section>

    <x-modal>
        @slot('id', 'delete-organization-modal')
        @slot('form', 'delete-organization-form')
        @slot('icon', 'warning')
        @slot('confirm', 'Supprimer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Supprimer l\'organisation')
        <x-slot name="body">
            <form id="delete-organization-form" action="" method="post">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="">

                <p class="text-gray-500">Vous êtes sur le point de définitivement supprimer cette organisation ! <br>

                    Cette action est <strong>irréversible</strong> ! <br>

                    Tous les utilisateurs vont être retirés de l'organisation, les buanderies, les machines et
                    toutes les réservations seront supprimées.

                    <br>

                    <strong>
                        Êtes-vous sûr de vouloir continuer ?
                    </strong>
                </p>
            </form>
        </x-slot>
    </x-modal>
@endsection
