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
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td data-title="Buanderie" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                            <!-- Name buandrie -->
                        </td>
                        <td data-title="Date" class="px-6 lg:py-4 text-center">
                            <!-- Date reservation -->
                        </td>
                        <td data-title="Type" class="px-6 lg:py-4 text-center">
                            <!-- Type of machine -->
                        </td>
                        <td class="px-6 py-4 text-center">
                            <!-- Route to delete user reservation -->
                            <form action="#" method="post">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <button type="submit" class="btn btn-sobre flex w-full justify-center">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    <!-- endforeach-->
                </tbody>
            </table>
        </div>
    </section>
@endsection
