@extends('layout.app')
@section('content')

    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Détail de l'utilisateur</h1>
    <section class="flex flex-col gap-4 items-center justify-center">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg table-mobile-display">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-justify dark:text-white dark:bg-gray-800">
                    <div class="mb-2">
                        <a href="{{ route('management.users.index', $orgID)  }}"
                           class="inline-flex items-center btn btn-sobre">
                            <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                            </svg>
                            Retour
                        </a>
                    </div>

                    Vous trouverez ici la <strong class="text-seaNymph">liste des réservations</strong> de l'utilisateur.
                    Vous avez la possibilité de supprimer ses réservations.
                </caption>

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="invisible text-center lg:visible">
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
                    <!-- foreach()-->
                    @foreach($reservations as $reservation)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td data-title="Buanderie" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                            <!-- Name buandrie -->
                            {{$reservation->laundry->name}}
                        </td>
                        <td data-title="Date" class="px-6 lg:py-4 text-center">
                            <!-- Date reservation -->
                            {{$reservation->start}}
                        </td>
                        <td data-title="Type" class="px-6 lg:py-4 text-center">
                            <!-- Type of machine -->
                            {{$reservation->machine->typeName()}}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <!-- Route to delete user reservation -->
                            <button type="submit" class="btn btn-sobre flex w-full justify-center btn-admin-delete-user-reservation"
                                    data-modal-target="delete-user-reservation-modal"
                                    data-modal-show="delete-user-reservation-modal"
                                    data-reservation-id="{{$reservation->id}}">
                                <!-- TODO Changer the route inside the app.js function deleteUserReservation -->
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    <!-- endforeach-->
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

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
