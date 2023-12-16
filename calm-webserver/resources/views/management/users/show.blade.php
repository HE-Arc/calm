@extends('layout.app')
@section('content')

    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Détail de l'utilisateur</h1>

    <article class="overflow-x-auto shadow-md sm:rounded-lg table-mobile-display">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-justify dark:text-white dark:bg-gray-800">
                Vous trouverez ici la <strong class="text-seaNymph">liste des réservations</strong> de l'utilisateur.
                Vous avez la possibilité de supprimer ses réservations.
            </caption>

            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Buanderie
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Supprimer réservation
                    </th>
                </tr>
            </thead>

            <tbody>
                @if ($reservations->isEmpty())
                    <tr>
                        <td colspan="4" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                            Aucune réservation n'a été créée
                        </td>
                    </tr>
                @else
                    <!-- foreach()-->
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td data-title="Buanderie" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                <!-- Name buandrie -->
                                {{ $reservation['machine']['name'] }}
                            </td>
                            <td data-title="Date" class="px-6 lg:py-4 text-center">
                                <!-- Date reservation -->
                                {{ $reservation['start'] }}
                            </td>
                            <td data-title="Type" class="px-6 lg:py-4 text-center">
                                <!-- Type of machine -->
                                {{ $reservation['machine']['typeName'] }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <!-- Route to delete user reservation -->
                                <button type="submit"
                                    class="btn btn-transparent flex w-full justify-center btn-admin-delete-user-reservation"
                                    data-modal-target="delete-user-reservation-modal"
                                    data-modal-show="delete-user-reservation-modal"
                                    data-reservation-id="{{ $reservation['id'] }}">
                                    <!-- TODO Changer the route inside the app.js function deleteUserReservation -->
                                    <span class="icons icons-forte">delete</span>
                                </button>
                            </td>
                        </tr>
                        <!-- endforeach-->
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="flex justify-center p-2">
            {{ $reservations->links() }}
        </div>
    </article>


    <x-modal>
        @slot('id', 'delete-user-reservation-modal')
        @slot('form', 'delete-user-reservation-form')
        @slot('icon', 'warning')
        @slot('confirm', 'Supprimer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Supprimer la réservation de l\'utilisateur')
        <x-slot name="body">
            <form id="delete-user-reservation-form" action="" method="post">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="">

                <p class="text-gray-500"><strong>!!! ATTENTION !!! </strong> Vous êtes sur le point de
                    <strong>DÉFINITIVEMENT</strong> supprimer la réservation de cet utilisateur ! <br>
                    Cette action est <strong>IRRÉVERSIBLE</strong> ! La réservation sera définitivement supprimée !
                    <br>
                    <strong>
                        Êtes-vous sûr de vouloir continuer ?
                    </strong>
                </p>
            </form>
        </x-slot>
    </x-modal>
@endsection
