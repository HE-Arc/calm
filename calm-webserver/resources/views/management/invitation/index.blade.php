@extends('layout.app')
@section('content')

    <!-- TODO Update the organizations\index.php to add right link to this view -->

    <div class="flex flex-col gap-4 items-center justify-center">
        <article class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm">
            <div class="flex flex-col gap-4 items-center justify-center">
                <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Gestion des invitations de l'organisation</h1>

                <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <caption class="p-5 text-justify dark:text-white dark:bg-gray-800">
                            Voici la liste de tous les <strong class="text-seaNymph">codes d'invitations</strong>
                            ayant permis aux utilisateurs d'entrer dans votre organisation.

                            <div class="pt-4 text-center lg:text-right">
                                <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                    <input type="checkbox" name="showOnlyActivateInvitations" value="showOnlyActivateInvitations"
                                           id="showOnlyActivateInvitations" class="sr-only peer choose-wash-dry" {{ old('showOnlyActivateInvitations') ? 'checked' : '' }}>
                                    <div class="toggle-switch peer peer-focus:ring-4 peer-focus:ring-vividTangerine peer-checked:after:translate-x-full peer-checked:after:border-white peer-checked:bg-vividTangerine"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Invitations actives</span>
                                </label>
                            </div>
                        </caption>

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="invisible text-center lg:visible">
                                <th scope="col" class="px-6 py-3">
                                    Date de création
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Code
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Crée par
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre d'inscriptions via ce code
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                        <!-- foreach($invitations as $invitation) -->
                            <!-- TODO Change if condition => if disable == true, the class is add -->
                            <tr class="bg-white border-b hover:bg-gray-50 @if(1 == 2)disable-line @endif">
                                <td data-title="Date de création" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                    12.10.2312
                                </td>
                                <td data-title="Code" class="px-6 lg:py-4 text-center">
                                    DSAD-DFEC-OFRG-DOER
                                </td>
                                <td data-title="Crée par" class="px-6 lg:py-4 text-center">
                                    admin@admin.com
                                </td>
                                <td data-title="Nombre d'inscriptions via ce code" class="px-6 lg:py-4 text-center">
                                    5
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <!-- TODO Change if condition => if disable == true, the activaer button is show -->
                                    @if(1 == 2)
                                        <button class="btn btn-sobre flex w-full justify-center">
                                            Activater
                                        </button>
                                    @else
                                        <button class="btn btn-sobre flex w-full justify-center">
                                            Désactiver
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            <tr class="bg-white border-b hover:bg-gray-50 @if(1 == 1)disable-line @endif">
                                <td data-title="Date de création" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                    12.10.2312
                                </td>
                                <td data-title="Code" class="px-6 lg:py-4 text-center">
                                    DSAD-DFEC-OFRG-DOER
                                </td>
                                <td data-title="Crée par" class="px-6 lg:py-4 text-center">
                                    admin@admin.com
                                </td>
                                <td data-title="Nombre d'inscriptions via ce code" class="px-6 lg:py-4 text-center">
                                    5
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <!-- TODO Change if condition => if disable == true, the activaer button is show -->
                                    @if(1 == 1)
                                        <button class="btn btn-sobre flex w-full justify-center">
                                            Activater
                                        </button>
                                    @else
                                        <button class="btn btn-sobre flex w-full justify-center">
                                            Désactiver
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        <!-- endforeach -->
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
        <!-- TODO Change variable for invitation -->
        {{$users->links()}}
    </div>
@endsection
