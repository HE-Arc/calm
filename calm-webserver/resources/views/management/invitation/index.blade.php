@extends('layout.app')
@section('content')
    <div class="flex flex-col gap-4 items-center justify-center">
        <article class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm">
            <div class="flex flex-col gap-4 items-center justify-center">
                <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Gestion des invitations de l'organisation</h1>

                <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
                    <table class="table-auto w-full">
                        <caption class="p-5 text-justify dark:text-white dark:bg-gray-800">
                            Voici la liste de tous les <strong class="text-seaNymph">codes d'invitations</strong>
                            ayant permis aux utilisateurs d'entrer dans votre organisation.

                            <div class="pt-4 text-center lg:text-left">
                                <form method="post" action="{{ route('invitation.create', ['org' => $org->id]) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn block lg:inline-block btn-forte">Créer une nouvelle
                                        invitation</button>
                                </form>
                            </div>

                            <div class="pt-4 text-center lg:text-right">
                                <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                    <input type="checkbox" name="showOnlyActivateInvitations"
                                        value="showOnlyActivateInvitations" id="showOnlyActivateInvitations"
                                        class="sr-only peer choose-wash-dry"
                                        {{ old('showOnlyActivateInvitations') ? 'checked' : '' }}>
                                    <div
                                        class="toggle-switch peer peer-focus:ring-4 peer-focus:ring-vividTangerine peer-checked:after:translate-x-full peer-checked:after:border-white peer-checked:bg-vividTangerine">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Invitations
                                        actives</span>
                                </label>
                            </div>
                        </caption>

                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date de création
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Code
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Créé par
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre d'inscriptions via ce code
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($invitations->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-6 lg:py-4 text-center font-medium text-gray-900">Aucune
                                        invitation n'a été créée</td>
                                </tr>
                            @else
                                @foreach ($invitations as $invitation)
                                    <tr class="@if (!$invitation->is_active) disable-line @endif">
                                        <td data-title="Date de création"
                                            class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                            {{ $invitation->created_at->format('d.m.Y') }}
                                        </td>
                                        <td data-title="Code" class="px-6 lg:py-4 text-center">
                                            <span class="pr-2 flex justify-evenly">
                                                <span class="code-to-copy">{{$invitation->code}}</span>
                                                <svg class="flowbite-icon-svg cursor-pointer copy-to-clipboard"
                                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                     fill="none" viewBox="0 0 18 20"
                                                     data-tooltip-target="tooltip-click" data-tooltip-trigger="click">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.708 2.292.706-.706A2 2 0 0 1 9.828 1h6.239A.97.97 0 0 1 17 2v12a.97.97 0 0 1-.933 1H15M6 5v4a1 1 0 0 1-1 1H1m11-4v12a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V9.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 5h5.239A.97.97 0 0 1 12 6Z"/>
                                                </svg>

                                                <div id="tooltip-click" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-seaNymph rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                    Texte copié
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                            </span>
                                        </td>
                                        <td data-title="Crée par" class="px-6 lg:py-4 text-center">
                                            {{ $invitation->user?->email }}
                                        </td>
                                        <td data-title="Nombre d'inscriptions via ce code" class="px-6 lg:py-4 text-center">
                                            {{ $invitation->userCount() }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if (!$invitation->is_active)
                                                <form method="post"
                                                    action="{{ route('invitation.enable', ['id' => $invitation->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-transparent flex w-full justify-center">
                                                        <span class="icons icons-sobre"> replay </span>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="post"
                                                    action="{{ route('invitation.disable', ['id' => $invitation->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-transparent flex w-full justify-center">
                                                        @if ($invitation->userCount() == 0)
                                                            <span class="icons icons-forte"> delete </span>
                                                        @else
                                                        <span class="icons icons-sobre"> block </span>
                                                        @endif
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
        {{ $invitations->links() }}
    </div>
@endsection
