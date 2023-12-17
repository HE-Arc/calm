@extends('layout.app')
@section('content')
    <article class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">

        <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Compte</h1>

        <div class="flex flex-row items-end mb-5">
            <div class="flex-grow w-full pr-4">
                <p>Nom d'utilisateur</p>
                <div class="flex input input-sobre">
                    <label class="flex-grow w-full">{{auth()->user()->name}}</label>
                    <span class="icons icons-sobre">mail</span>
                </div>
            </div>
            <div class="flex-grow w-full pl-4">
                <button type="submit" class="btn btn-sobre flex w-full justify-center p-3"
                        data-modal-target="user-account-edit-name-modal"
                        data-modal-show="user-account-edit-name-modal">Modifier</button>
            </div>
        </div>

        <div class="flex flex-row items-end mb-5">
            <div class="flex-grow w-full pr-4">
                <p>Adresse e-mail</p>
                <div class="flex input input-sobre">
                    <label class="flex-grow w-full">{{auth()->user()->email}}</label>
                    <span class="icons icons-sobre">mail</span>
                </div>
            </div>
            <div class="flex-grow w-full pl-4">
                <button type="submit" class="btn btn-sobre flex w-full justify-center p-3"
                        data-modal-target="user-account-edit-email-modal"
                        data-modal-show="user-account-edit-email-modal">Modifier</button>
            </div>
        </div>

        <div class="flex flex-row items-end mb-5">
            <div class="flex-grow w-full pr-4">
                <p>Mot de passe</p>
                <div class="flex input input-sobre">
                    <label class="flex-grow w-full">************</label>
                    <span class="icons icons-sobre">lock</span>
                </div>
            </div>
            <div class="flex-grow w-full pl-4">
                <button type="submit" class="btn btn-sobre flex w-full justify-center pt-3 pb-3"
                        data-modal-target="user-account-edit-password-modal"
                        data-modal-show="user-account-edit-password-modal">Modifier</button>
            </div>
        </div>

        <h2 class="font-title text-4xl text-center my-3 text-seaNymph mt-10">Vos organisations</h2>
        <article class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="table-auto w-full">
                <caption class="p-5 text-justify dark:text-white dark:bg-gray-800">
                    Voici la liste des organisations auxquelles vous appartenez. Vous avez la possiblité d'en quitter.
                </caption>
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nom de l'organisation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quitter
                    </th>
                </tr>
                </thead>
                <tbody>
                @if ($organizations->isEmpty())
                    <tr>
                        <td colspan="5" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                            Vous ne faites parti d'aucune organisation. <br>
                            <a class="btn btn-forte my-5 inline-block" href="{{ route('invitation.joinView')}}">Rejoindre une organisation</a>
                        </td>
                    </tr>
                @else
                    @foreach ($organizations as $organization)
                        <tr>
                            <td data-title="Nom" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                {{ $organization->name }}
                            </td>
                            <td data-title="Quitter" class="px-6 py-4 text-center">
                                <button type="submit" class="btn btn-transparent btn-exit-organization"
                                        data-organization-id="{{ $organization->id }}"
                                        data-modal-target="quit-organization-modal"
                                        data-modal-show="quit-organization-modal">
                                    <span class="icons icons-forte">logout</span>
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

        <button class="btn btn-less-forte w-full mt-20"
                data-modal-target="user-account-delete-confirm-modal"
                data-modal-show="user-account-delete-confirm-modal">Supprimer le compte</button>
    </article>

    <x-modal>
        @slot('id', 'user-account-edit-email-modal')
        @slot('form', 'user-account-edit-email-form')
        @slot('confirm', 'Confirmer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Modification de l\'adresse e-mail')
        <x-slot name="body">
            <form action="{{route('user.email')}}" method="POST" id="user-account-edit-email-form">
                @csrf
                @method("PUT")
                <div class="mb-5">
                    <label>Ancienne adresse e-mail</label>

                    <div class="relative mt-2 opacity-80">
                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                            </svg>
                        </div>

                        <input type="email" value="{{auth()->user()->email}}" disabled class="block w-full pl-10 input input-sobre">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="email">Nouvelle adresse e-mail</label>
                    <div class="relative mt-2">

                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full pl-10 input input-sobre">
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>

    <x-modal>
        @slot('id', 'user-account-edit-password-modal')
        @slot('form', 'user-account-edit-password-form')
        @slot('confirm', 'Confirmer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Modification du mot de passe')
        <x-slot name="body">
            <form action="{{route('user.password')}}" method="POST" id="user-account-edit-password-form">
                @csrf
                @method("PUT")

                <div>
                    <label for="current_password">Mot de passe actuel</label>
                    <div class="relative mt-2 mb-5">
                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z"/>
                            </svg>
                        </div>
                        <input id="current_password" name="current_password" type="password" required class="block w-full pl-10 input input-sobre">
                    </div>
                </div>

                <div>
                    <label for="new_password" >Nouveau mot de passe</label>
                    <div class="relative mt-2 mb-5">
                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z"/>
                            </svg>
                        </div>

                        <input id="new_password" name="new_password" type="password" required class="block w-full pl-10 input input-sobre">
                    </div>
                </div>

                <div>
                    <label for="repeat_password" >Confirmation du mot de passe</label>
                    <div class="relative mt-2 mb-5">
                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z"/>
                            </svg>
                        </div>

                        <input id="repeat_password" name="repeat_password" type="password" required class="block w-full pl-10 input input-sobre">
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>

    <x-modal>
        @slot('id', 'user-account-edit-name-modal')
        @slot('form', 'user-account-edit-name-form')
        @slot('confirm', 'Confirmer')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Modification du nom d\'utilisateur')
        <x-slot name="body">
            <form action="{{route('user.name')}}" id="user-account-edit-name-form" method="POST">
                @csrf
                @method("PUT")
                <div class="mb-5">
                    <label>Ancien nom d'utilisateur</label>

                    <div class="relative mt-2 opacity-80">
                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                                <path d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                            </svg>
                        </div>

                        <input type="text" value="{{auth()->user()->name}}" disabled class="block w-full pl-10 input input-sobre">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="name">Nouveau nom d'utilisateur</label>
                    <div class="relative mt-2">

                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                                <path d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                            </svg>
                        </div>
                        <input id="name" name="name" type="text" required class="block w-full pl-10 input input-sobre">
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>

    <x-modal>
        @slot('id', 'user-account-delete-confirm-modal')
        @slot('form', 'delete-account-form')
        @slot('icon', 'warning')
        @slot('confirm', 'SUPPRIMER')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Supprimer votre compte')
        <x-slot name="body">
            <form action="{{route('user.index')}}" method="POST" id="delete-account-form">
                @csrf
                @method("DELETE")

                <div>
                    <label for="current_password">Mot de passe actuel</label>
                    <div class="relative mt-2 mb-5">
                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z"/>
                            </svg>
                        </div>
                        <input id="current_password" name="current_password" type="password" required class="block w-full pl-10 input input-sobre">
                    </div>
                </div>

                <p class="text-gray-500"><strong>!!! ATTENTION !!! </strong> Vous êtes sur le point de
                    <strong>DÉFINITIVEMENT</strong> supprimer votre compte ! <br>
                    Cette action est <strong>IRRÉVERSIBLE</strong> ! Toutes vos réservations seront définitivement supprimées !
                    Vous ne pourrez plus rejoindre votre organisation à moins d'y être à nouveau invité !
                    <br>
                    <br>
                    <strong>
                        Êtes-vous sûr de vouloir continuer ?
                    </strong>
                </p>
            </form>
        </x-slot>
    </x-modal>

    <x-modal>
        @slot('id', 'quit-organization-modal')
        @slot('form', 'quit-organization-form')
        @slot('icon', 'warning')
        @slot('confirm', 'Quitter')
        @slot('close', 'Annuler')
        @slot('closable', true)
        @slot('header', 'Quitter l\'organisation')
        <x-slot name="body">
            <form id="quit-organization-form" action="#" method="post">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="">

                <p class="text-gray-500"><strong>!!! ATTENTION !!! </strong> Vous êtes sur le point de
                    <strong>DÉFINITIVEMENT</strong> quitter cette organisation ! <br>
                    Cette action est <strong>IRRÉVERSIBLE</strong> ! Vous ne ferez plus parti de l'organisation, à
                    moins de la rejoindre à nouveau !
                    <br>
                    <strong>
                        Êtes-vous sûr de vouloir continuer ?
                    </strong>
                </p>
            </form>
        </x-slot>
    </x-modal>
@endsection
