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

                            <div class="pt-4 text-center lg:text-left">
                                <form method="post" action="{{ route('invitation.create', ['org' => $org->id]) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn block lg:inline-block btn-forte">Créer une nouvelle invitation</button>
                                </form>
                            </div>

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
                            @foreach($invitations as $invitation)
                            <tr class="bg-white border-b hover:bg-gray-50 @if(!$invitation->is_active)disable-line @endif">
                                <td data-title="Date de création" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                    {{$invitation->created_at->format("d.m.Y")}}
                                </td>
                                <td data-title="Code" class="px-6 lg:py-4 text-center">
                                    {{$invitation->code}}
                                </td>
                                <td data-title="Crée par" class="px-6 lg:py-4 text-center">
                                    {{ $invitation->user?->email }}
                                </td>
                                <td data-title="Nombre d'inscriptions via ce code" class="px-6 lg:py-4 text-center">
                                    {{$invitation->userCount()}}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if(!$invitation->is_active)
                                        <form method="post" action="{{route('invitation.enable', ['id' => $invitation->id])}}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sobre flex w-full justify-center">
                                                Activer
                                            </button>
                                        </form>
                                    @else
                                        <form method="post" action="{{route('invitation.disable', ['id' => $invitation->id])}}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sobre flex w-full justify-center">
                                                @if($invitation->userCount() == 0) Supprimer @else Désactiver @endif
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
        {{$invitations->links()}}
    </div>
@endsection
